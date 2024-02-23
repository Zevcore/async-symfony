<?php
declare(strict_types=1);

namespace App\Message;

readonly class PurchaseConfirmationNotification
{
    public function __construct(
        private object $order
    ) {}

    public function getOrder(): object
    {
        return $this->order;
    }
}