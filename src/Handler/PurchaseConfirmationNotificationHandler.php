<?php
declare(strict_types=1);

namespace App\Handler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{
    public function __construct(
        private MailerInterface $mailer
    ){}

    public function __invoke(PurchaseConfirmationNotification $notification): void
    {
        // TODO: Create PDF
        echo 'Creating a pdf...';

        $email = (new Email())
            ->from('sales@stockapp.com')
            ->to($notification->getOrder()->getBuyer()->getEmail())
            ->subject('Contract note for order ' . $notification->getOrder()->getId())
            ->text("here is your note");

        $this->mailer->send($email);
    }
}