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

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * User roles manager.
 *
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class RolesManager
{
    /** @var array */
    protected $roles;

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     * @param string[]            $roles
     */
    public function __construct(TranslatorInterface $translator, array $roles)
    {
        $this->translator = $translator;
        $this->roles = $roles;
    }

    /**
     * Returns a list of choice for user's roles.
     *
     * @return array
     */
    public function getChoices()
    {
        $choices = $this->getFlatRoles();

        if (isset($choices['ROLE_SUPER_ADMIN'])) {
            unset($choices['ROLE_SUPER_ADMIN']);
        }

        return $choices;
    }

    /**
     * Gets the current role of a user.
     *
     * @param UserInterface $user
     *
     * @return string
     */
    public function getUserRole(UserInterface $user)
    {
        $currentRole = '';
        $userRoles = $user->getRoles();

        if (in_array($userRoles[0], $this->getFlatRoles())) {
            $currentRole = $userRoles[0];
        }

        return $currentRole;
    }

    /**
     * Returns a simple list of roles.
     *
     * Transform the "security.role_hierarchy.roles" parameter:
     *
     * [
     *      'ROLE_ADMIN'       => ['ROLE_USER'],
            'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN'],
     * ]
     *
     * into:
     *
     * ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN']
     *
     * @return string[]
     */
    protected function getFlatRoles()
    {
        $choices = [];

        foreach ($this->roles as $key => $roles) {
            foreach ($roles as $role) {
                if (!isset($choices[$role])) {
                    $choices[$role] = $role;
                }
            }

            if (!isset($choices[$key])) {
                $choices[$key] = $key;
            }
        }

        return $choices;
    }
}
