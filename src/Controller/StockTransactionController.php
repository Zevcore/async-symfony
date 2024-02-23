<?php
declare(strict_types=1);

namespace App\Controller;

use App\Message\PurchaseConfirmationNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class StockTransactionController extends AbstractController
{
    #[Route('/buy', name: 'buy-stock')]
    public function buy(MessageBusInterface $bus): Response
    {
        // Temporary code
        $order = new class {
          public function getBuyer(): object
          {
              return new class {
                  public function getEmail(): string {
                      return 'email@email.email';
                  }
              };
          }
        };

        // TODO: Dispatch confirmation message
        $bus->dispatch(new PurchaseConfirmationNotification($order));

        // TODO: Display
        return $this->render('stocks/example.html.twig');
    }

}