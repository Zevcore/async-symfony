<?php
declare(strict_types=1);

namespace App\Handler;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PurchaseConfirmationNotificationHandler
{
    public function __invoke(PurchaseConfirmationNotification $notification): void
    {
        // TODO: Create PDF
        echo 'Creating a pdf...';

        // TODO: Send email
        echo 'Sending email to ' . $notification->getOrder()->getBuyer()->getEmail();
    }
}