<?php
declare(strict_types=1);

namespace App\Handler;

use App\Message\PurchaseConfirmationNotification;
use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
readonly class PurchaseConfirmationNotificationHandler
{
    public function __construct(
        private MailerInterface $mailer
    ){}

    /**
     * @throws TransportExceptionInterface
     * @throws MpdfException
     */
    public function __invoke(PurchaseConfirmationNotification $notification): void
    {
        // TODO: Create PDF
        echo 'Creating a pdf...';
        $mpdf = new Mpdf();
        $content = "<h1>Contract Note For Order {$notification->getOrder()->getId()}</h1>";
        $content .= "<p>Total: <b>$21.37</b></b>";

        $mpdf->writeHtml($content);
        $contractNotePdf = $mpdf->output('', 'S');


        $email = (new Email())
            ->from('sales@stockapp.com')
            ->to($notification->getOrder()->getBuyer()->getEmail())
            ->subject('Contract note for order ' . $notification->getOrder()->getId())
            ->text("here is your note")
            ->attach($contractNotePdf, 'contract-note.pdf');

        $this->mailer->send($email);
    }
}