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

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User repository.
 *
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findAllBut(UserInterface $user)
    {
        $query = $this->createQueryBuilder('u')
            ->where('u.username != :username')
            ->setParameter('username', $user->getUsername())
            ->orderBy('u.username')
            ->getQuery();

        return $query->getResult();
    }
}
