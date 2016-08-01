<?php

namespace Carcel\Bundle\UserBundle\Manager;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Mail manager.
 *
 * @author    Damien Carcel (damien.carcel@gmail.com)
 * @copyright 2016 Damien Carcel (https://github.com/damien-carcel)
 * @license   https://opensource.org/licenses/mit   The MIT license (MIT)
 */
class MailManager
{
    /** @var string */
    protected $mailerAddress;

    /** @var \Swift_Mailer */
    protected $mailer;

    /** @var EngineInterface */
    protected $templating;

    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @param EngineInterface     $templating
     * @param \Swift_Mailer       $mailer
     * @param TranslatorInterface $translator
     * @param string              $mailerAddress
     */
    public function __construct(
        EngineInterface $templating,
        \Swift_Mailer $mailer,
        TranslatorInterface $translator,
        $mailerAddress
    ) {
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->translator = $translator;
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
        $message = \Swift_Message::newInstance();
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
