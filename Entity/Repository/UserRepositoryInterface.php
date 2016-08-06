<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Entity\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User repository interface.
 *
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
interface UserRepositoryInterface extends ObjectRepository
{
    /**
     * Retrieves all users but one.
     *
     * @param UserInterface $user The user we don\'t want to be returned.
     *
     * @return UserInterface[]
     */
    public function findAllBut(UserInterface $user);
}
