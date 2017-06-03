<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Main class of the UserBundle.
 *
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class CarcelUserBundle extends Bundle
{
    /**
     * Makes the UserBundle inherit from FOSUserBundle.
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
