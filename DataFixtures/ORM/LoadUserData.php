<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\DataFixtures\ORM;

use Carcel\Bundle\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class LoadUserData implements FixtureInterface
{
    /** @var array */
    protected static $userData = [
        [
            'username' => 'admin',
            'password' => 'admin',
            'email'    => 'admin@userbundle.info',
            'role'     => 'ROLE_SUPER_ADMIN',
            'enabled'  => true,
        ],
        [
            'username' => 'aurore',
            'password' => 'aurore',
            'email'    => 'aurore@userbundle.info',
            'role'     => 'ROLE_ADMIN',
            'enabled'  => true,
        ],
        [
            'username' => 'damien',
            'password' => 'damien',
            'email'    => 'damien@userbundle.info',
            'role'     => '',
            'enabled'  => true,
        ],
        [
            'username' => 'lilith',
            'password' => 'lilith',
            'email'    => 'lilith@userbundle.info',
            'role'     => '',
            'enabled'  => false,
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach (static::$userData as $data) {
            $user = $this->createUser($data);
            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @param array $userData
     *
     * @return User
     */
    protected function createUser(array $userData)
    {
        $user = new User();

        $user->setUsername($userData['username']);
        $user->setPlainPassword($userData['password']);
        $user->setEmail($userData['email']);
        $user->setEnabled($userData['enabled']);

        if (!empty($userData['role'])) {
            $user->setRoles([$userData['role']]);
        }

        return $user;
    }
}
