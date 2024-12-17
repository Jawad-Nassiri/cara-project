<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;

class PaymentController extends BaseController {

    public function processPayment() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $basket = $_SESSION['basket'] ?? null;
            $idMembre = $_SESSION['user_id'] ?? null;

            if (!$basket || !$idMembre) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Basket data or user ID missing. Please check your session.'
                ]);
                return;
            }

            $repository = new CommandeRepository();

            foreach ($basket as $index => $item) {
                if (!isset($item['id'], $item['name'], $item['price'], $item['size'], $item['quantity'])) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Missing required item data (price, quantity, size, or productId) in item ' . $index . ': ' . json_encode($item)
                    ]);
                    return;
                }

                $price = $item['price'];
                $cleanPrice = preg_replace('/[^\d.]/', '', $price);
                $priceFloat = floatval($cleanPrice);

                if ($priceFloat <= 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid price format for product ID: ' . $item['id'] . '. Cleaned price: ' . $cleanPrice
                    ]);
                    return;
                }

                $quantity = (int) $item['quantity'];
                if ($quantity <= 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid quantity for product ID: ' . $item['id']
                    ]);
                    return;
                }

                $montant = $priceFloat * $quantity;
                if ($montant <= 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid amount for product ID: ' . $item['id'] . '. Calculated amount: ' . $montant
                    ]);
                    return;
                }

                $commande = new Commande();
                $commande->setMontant($montant);
                $commande->setSize($item['size']);
                $commande->setDateEnregistrement(date('Y-m-d H:i:s')); 
                $commande->setIdMembre($idMembre);
                $commande->setProductId($item['id']);

                $success = $repository->saveCommand($commande);
                if (!$success) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to save product with ID: ' . $item['id']
                    ]);
                    return;
                }
            }

            unset($_SESSION['basket']);
            $_SESSION['basket_count'] = 0;

            echo json_encode([
                'success' => true,
                'message' => 'Payment processed successfully.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function showPaymentPage() {
        $this->render('paymentPage.html.php', []);
    }
}
