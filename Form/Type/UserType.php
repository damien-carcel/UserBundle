<?php

namespace Carcel\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Form type for editing user information.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
 */
class UserType extends AbstractType
{
    /** @var string */
    protected $class;

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     * @param string              $class
     */
    public function __construct(TranslatorInterface $translator, $class)
    {
        $this->translator = $translator;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'username',
            TextType::class,
            ['label' => $this->translator->trans('carcel_user.form.name.label')]
        );

        $builder->add(
            'email',
            EmailType::class,
            ['label' => $this->translator->trans('carcel_user.form.email.label')]
        );

        $builder->add(
            'submit',
            SubmitType::class,
            ['label' => $this->translator->trans('carcel_user.button.update')]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => $this->class]);
    }
}
