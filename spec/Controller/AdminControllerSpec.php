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

use Carcel\Bundle\UserBundle\Controller\AdminController;
use PhpSpec\ObjectBehavior;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class AdminControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AdminController::class);
    }

    function it_is_a_symfony_framework_controller()
    {
        $this->shouldHaveType(Controller::class);
    }

    function it_is_a_container_aware_controller()
    {
        $this->shouldImplement(ContainerAwareInterface::class);
    }
}
