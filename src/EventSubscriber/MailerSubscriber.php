<?php

/*
 * This file is part of CarcelUserBundle.
 *
 * Copyright (c) 2016 Damien Carcel <damien.carcel@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carcel\Bundle\UserBundle\EventSubscriber;

use Carcel\Bundle\UserBundle\Event\UserEvents;
use Carcel\Bundle\UserBundle\Manager\MailManager;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Subscriber that sends email to a user when its account has been removed.
 *
 * @author Damien Carcel <damien.carcel@gmail.com>
 */
class MailerSubscriber implements EventSubscriberInterface
{
    /** @var string */
    protected $mailAddress;

    /** @var MailManager */
    protected $mailManager;

    /** @var string */
    protected $username;

    /**
     * @param MailManager $mailManager
     */
    public function __construct(MailManager $mailManager)
    {
        $this->mailManager = $mailManager;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            UserEvents::PRE_REMOVE => 'getUserEmail',
            UserEvents::POST_REMOVE => 'sendMessage',
        ];
    }

    /**
     * Gets the username and mail address of the user to be removed.
     *
     * @param GenericEvent $event
     */
    public function getUserEmail(GenericEvent $event)
    {
        $user = $event->getSubject();

        if (!$user instanceof UserInterface) {
            throw new \InvalidArgumentException('MailerSubscriber event is expected to contain an instance of User');
        }

        $this->mailAddress = $user->getEmail();
        $this->username = $user->getUsername();
    }

    /**
     * Sends an email to the removed user.
     */
    public function sendMessage()
    {
        $this->mailManager->send(
            $this->mailAddress,
            $this->username,
            'carcel_user.mail.remove.subject',
            'carcel_user.mail.remove.body'
        );
    }
}
