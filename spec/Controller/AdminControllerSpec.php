<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Carcel\Bundle\UserBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class AdminControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Carcel\Bundle\UserBundle\Controller\AdminController');
    }

    function it_is_a_symfony_framework_controller()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Controller\Controller');
    }

    function it_is_a_container_aware_controller()
    {
        $this->shouldImplement('Symfony\Component\DependencyInjection\ContainerAwareInterface');
    }
}
