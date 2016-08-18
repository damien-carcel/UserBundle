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

use Carcel\Bundle\UserBundle\Entity\Repository\UserRepositoryInterface;
use Carcel\Bundle\UserBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class UserManager
{
    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /** @var UserRepositoryInterface */
    protected $userRepository;

    /**
     * @param TokenStorageInterface  $tokenStorage
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    /**
     * @return UserInterface[]
     */
    public function getAdministrableUsers()
    {
        $users = [];

        $currentUser = $this->tokenStorage->getToken()->getUser();
        $users[] = $currentUser;

        if (!$currentUser->hasRole('ROLE_SUPER_ADMIN')) {
            $superAdmin = $this->userRepository->findByRole('ROLE_SUPER_ADMIN');
            $users = array_merge($users, $superAdmin);
        }

        return $this->userRepository->findAllBut($users);
    }
}
