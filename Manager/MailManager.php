<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\Manager;

use Carcel\Bundle\UserBundle\Factory\SwiftMessageFactory;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Mail manager.
 *
 * @author Damien Carcel (damien.carcel@gmail.com)
 */
class MailManager
{
    /** @var \Swift_Mailer */
    protected $mailer;

    /** @var string */
    protected $mailerAddress;

    /** @var SwiftMessageFactory */
    protected $messageFactory;

    /** @var EngineInterface */
    protected $templating;

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param \Swift_Mailer       $mailer
     * @param EngineInterface     $templating
     * @param TranslatorInterface $translator
     * @param SwiftMessageFactory $messageFactory
     * @param string              $mailerAddress
     */
    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating,
        TranslatorInterface $translator,
        SwiftMessageFactory $messageFactory,
        $mailerAddress
    ) {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->messageFactory = $messageFactory;
        $this->mailerAddress = $mailerAddress;
    }

    /**
     * Sends an email.
     *
     * @param string $email
     * @param string $username
     *
     * @return int The number of successful recipients. Can be 0 which indicates failure
     */
    public function send($email, $username)
    {
        $message = $this->messageFactory->create();
        $message
            ->setSubject($this->translator->trans('carcel_user.account.remove'))
            ->setFrom($this->mailerAddress)
            ->setTo($email)
            ->setBody(
                $this->templating->render(
                    'CarcelUserBundle:Admin:email.txt.twig',
                    ['username' => $username]
                )
            );

        return $this->mailer->send($message);
    }
}
