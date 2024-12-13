<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;

class PaymentController extends BaseController {

    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartData = $_SESSION['cartData'] ?? null;
            $idMembre = $_SESSION['user_id'] ?? null;
            // d_die($idMembre);
            
            if (!$cartData || !$idMembre) {
                echo json_encode(['success' => false, 'message' => 'No cart data or user not logged in.']);
                return;
            }
            
            $repository = new CommandeRepository();
            
            foreach ($cartData['cartData'] as $index => $item) {
                if (!isset($item['productId'], $item['name'], $item['price'], $item['size'], $item['quantity'])) {
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
                        'message' => 'Invalid price format for product ID: ' . $item['productId'] . '. Cleaned price: ' . $cleanPrice
                    ]);
                    return;
                }

                $quantity = (int) $item['quantity'];
                if ($quantity <= 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid quantity for product ID: ' . $item['productId']
                    ]);
                    return;
                }

                $montant = $priceFloat * $quantity;
                if ($montant <= 0) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid amount for product ID: ' . $item['productId'] . '. Calculated amount: ' . $montant
                    ]);
                    return;
                }

                $commande = new Commande();
                $commande->setMontant($montant);
                $commande->setSize($item['size']);
                $commande->setDateEnregistrement(date('Y-m-d H:i:s')); 
                $commande->setIdMembre($idMembre);
                $commande->setProductId($item['productId']);

                // Save the command in the database
                $success = $repository->saveCommand($commande);
                if (!$success) {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Failed to save product with ID: ' . $item['productId']
                    ]);
                    return;
                }
            }

            // unset($_SESSION['cartData']); 

            echo json_encode([
                'success' => true,
                'message' => 'Payment processed successfully.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
}
