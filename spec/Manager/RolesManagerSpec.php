<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Carcel\Bundle\UserBundle\Manager;

use Carcel\Bundle\UserBundle\Manager\RolesManager;
use FOS\UserBundle\Model\UserInterface;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class RolesManagerSpec extends ObjectBehavior
{
    function let(TranslatorInterface $translator)
    {
        $this->beConstructedWith(
            $translator,
            [
                'ROLE_EDITOR'      => ['ROLE_USER'],
                'ROLE_ADMIN'       => ['ROLE_EDITOR'],
                'ROLE_SUPER_ADMIN' => ['ROLE_ADMIN'],
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RolesManager::class);
    }

    function it_returns_the_list_of_roles_without_super_admin_one()
    {
        $this->getChoices()->shouldReturn([
            'ROLE_USER'   => 'ROLE_USER',
            'ROLE_EDITOR' => 'ROLE_EDITOR',
            'ROLE_ADMIN'  => 'ROLE_ADMIN',
        ]);
    }

    function it_returns_the_role_of_a_user(UserInterface $user)
    {
        $user->getRoles()->willReturn(['ROLE_USER']);

        $this->getUserRole($user)->shouldReturn('ROLE_USER');
    }
}
