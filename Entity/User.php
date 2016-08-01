<?php

namespace Carcel\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User entity.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
 */
class User extends BaseUser
{
    /** @var int */
    protected $id;
}
