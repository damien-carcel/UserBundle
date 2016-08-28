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

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param \Swift_Mailer       $mailer
     * @param TranslatorInterface $translator
     * @param SwiftMessageFactory $messageFactory
     * @param string              $mailerAddress
     */
    public function __construct(
        \Swift_Mailer $mailer,
        TranslatorInterface $translator,
        SwiftMessageFactory $messageFactory,
        $mailerAddress
    ) {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->messageFactory = $messageFactory;
        $this->mailerAddress = $mailerAddress;
    }

    /**
     * Sends an email.
     *
     * @param string $mailAddress
     * @param string $username
     * @param string $subject
     * @param string $content
     *
     * @return int The number of successful recipients. Can be 0 which indicates failure
     */
    public function send($mailAddress, $username, $subject, $content)
    {
        $message = $this->messageFactory->create();
        $message
            ->setSubject($this->translator->trans($subject))
            ->setFrom($this->mailerAddress)
            ->setTo($mailAddress)
            ->setBody(
                $this->translator->trans(
                    $content,
                    ['username' => $username]
                )
            );

        return $this->mailer->send($message);
    }
}
