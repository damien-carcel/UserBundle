<?php

namespace Carcel\Bundle\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User repository.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
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
