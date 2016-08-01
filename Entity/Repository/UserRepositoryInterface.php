<?php

namespace Carcel\Bundle\UserBundle\Entity\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User repository interface.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
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
