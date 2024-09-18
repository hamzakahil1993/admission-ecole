<?php

namespace App\Service;

use App\Entity\Assertion;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Environment;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $twig;
    private $params;

    public function __construct(Environment $twig, ParameterBagInterface $params)
    {
        $this->twig = $twig;
        $this->params = $params;
    }

    public function sendEmailNewAssertion(Assertion $assertion)
    {
        $dsn = $this->params->get('app.mailer_dns');
        $senderEmail = $this->params->get('app.sender_email');
        $receiverEmail = $this->params->get('app.receiver_email');
        $subject = sprintf('New assertion %s', $assertion->getId());
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);
        $htmlContent = $this->twig->render('email/new_assertion.html.twig', [
            'subject' => $subject,
            'assertion' => $assertion,
        ]);
        $email = (new Email())
            ->from($senderEmail)
            ->to($receiverEmail)
            ->subject($subject)
            ->html($htmlContent);
        $mailer->send($email);
    }

    public function sendEmailNewAssertionDocuements(Assertion $assertion)
    {
        $dsn = $this->params->get('app.mailer_dns');
        $senderEmail = $this->params->get('app.sender_email');
        $receiverEmail = $this->params->get('app.receiver_email');
        $subject = sprintf('New assertion %s', $assertion->getId());
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);
        $htmlContent = $this->twig->render('email/new_assertion_document.html.twig', [
            'subject' => $subject,
            'assertion' => $assertion,
        ]);
        $email = (new Email())
            ->from($senderEmail)
            ->to($receiverEmail)
            ->subject($subject)
            ->html($htmlContent);
        $mailer->send($email);
    }
}
