<?php

namespace spec\Carcel\Bundle\UserBundle\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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
