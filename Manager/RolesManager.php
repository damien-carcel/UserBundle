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
        $choices = [];
        $choices['ROLE_USER'] = 'ROLE_USER';

        $roles = array_keys($this->roles);

        foreach ($roles as $role) {
            if ($role !== 'ROLE_SUPER_ADMIN') {
                $choices[$role] = $role;
            }
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
        $userRoles = $user->getRoles();

        $currentRole = '';
        foreach ($this->roles as $role) {
            if ($role[0] === $userRoles[0]) {
                $currentRole = $role[0];
            }
        }

        return $currentRole;
    }
}
