<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Carcel\Bundle\UserBundle\Form\Type;

use Carcel\Bundle\UserBundle\Entity\User;
use Carcel\Bundle\UserBundle\Form\Type\UserType;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class UserTypeSpec extends ObjectBehavior
{
    function let(TranslatorInterface $translator)
    {
        $this->beConstructedWith($translator, User::class);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UserType::class);
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_sets_a_default_configuration(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => User::class])->shouldBeCalled();

        $this->configureOptions($resolver);
    }

    function it_builds_a_user_form($translator, FormBuilderInterface $builder)
    {
        $translator->trans('carcel_user.form.name.label')->willReturn('Name');
        $translator->trans('carcel_user.form.email.label')->willReturn('Email');
        $translator->trans('carcel_user.button.update')->willReturn('Update');

        $builder
            ->add('username', TextType::class, ['label' => 'Name'])
            ->shouldBeCalled();

        $builder
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->shouldBeCalled();

        $builder
            ->add('submit', SubmitType::class, ['label' => 'Update'])
            ->shouldBeCalled();

        $this->buildForm($builder, []);
    }
}
