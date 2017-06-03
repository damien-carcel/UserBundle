<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Factory;

/**
 * Creates a new instance of \Swift_Message.
 *
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class SwiftMessageFactory
{
    /**
     * @return \Swift_Message
     */
    public function create()
    {
        return \Swift_Message::newInstance();
    }
}
