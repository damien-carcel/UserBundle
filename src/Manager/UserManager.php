<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Manager;

use Carcel\Bundle\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * User manager.
 *
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class UserManager
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var RolesManager */
    protected $rolesManager;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * @param TokenStorageInterface  $tokenStorage
     * @param EntityManagerInterface $entityManager
     * @param RolesManager           $rolesManager
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityManagerInterface $entityManager,
        RolesManager $rolesManager
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->rolesManager = $rolesManager;
    }

    /**
     * @return UserInterface[]
     */
    public function getAdministrableUsers()
    {
        $users = [];

        $userRepository = $this->entityManager->getRepository(User::class);
        $currentUser = $this->tokenStorage->getToken()->getUser();
        $users[] = $currentUser;

        if (!$currentUser->isSuperAdmin()) {
            $superAdmin = $userRepository->findByRole('ROLE_SUPER_ADMIN');
            $users = array_merge($users, $superAdmin);
        }

        return $userRepository->findAllBut($users);
    }

    /**
     * Sets a user role.
     *
     * New role is provided as an key-value array:
     * [
     *     'roles' => 'ROLE_TO_SET',
     * ]
     *
     * @param UserInterface $user
     * @param array         $selectedRole
     */
    public function setRole(UserInterface $user, array $selectedRole)
    {
        $choices = $this->rolesManager->getChoices();

        if (!isset($choices[$selectedRole['roles']])) {
            throw new InvalidArgumentException(
                sprintf('Impossible to set role %s', $selectedRole['roles'])
            );
        }

        $user->setRoles([$choices[$selectedRole['roles']]]);

        $this->entityManager->flush();
    }
}
