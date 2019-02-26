<?php

namespace AppBundle\Mail;

use AppBundle\Model\Contact;
use Symfony\Bundle\TwigBundle\TwigEngine as Templating;
use Symfony\Component\Translation\TranslatorInterface;
use Swift_Mailer;


class Sender
{
    /** @var \Swift_Mailer */
    protected $mailer;

    /** @var  \Symfony\Component\Translation\TranslatorInterface */
    protected $translator;

    /** @var \Symfony\Bundle\TwigBundle\TwigEngine */
    protected $templating;

    /** @var string */
    protected $senderEmail;

    /** @var string */
    protected $recipientEmail;

    /**
     * @param \Swift_Mailer $mailer
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     * @param \Symfony\Bundle\TwigBundle\TwigEngine $templating
     * @param string $senderEmail
     * @param string $recipientEmail
     */
    public function __construct(
        Swift_Mailer $mailer,
        TranslatorInterface $translator,
        Templating $templating,
        $senderEmail,
        $recipientEmail
    ) {
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->templating = $templating;
        $this->senderEmail = $senderEmail;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * @param Contact $contact
     */
    public function send(Contact $contact)
    {
        $title = $this->translator->trans('You have a new message from %from%', ['%from%' => $contact->getFrom()]);
        $message = (new \Swift_Message($title, $contact->getMessage()))
            ->setFrom($this->senderEmail)
            ->setTo($this->recipientEmail)
            ->setReplyTo($this->recipientEmail)
            ->setBody('aaa')
            ;
        $this->mailer->send($message);
    }
}
