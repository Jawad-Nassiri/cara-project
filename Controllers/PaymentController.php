<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;

class PaymentController extends BaseController {

    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $basket = $_SESSION['basket_data'] ?? null;
            $idMembre = $_SESSION['user_id'] ?? null;
            

            if (!$basket || !$idMembre) {
                echo "Basket data or user ID missing";
                return;
            }

            $repository = new CommandeRepository();

            foreach ($basket as $item) {
                $price = preg_replace('/[^\d.]/', '', $item['price']);
                $priceFloat = floatval($price);
                $quantity = (int) $item['quantity'];
                // d_die($quantity);
                $montant = $priceFloat * $quantity;
            
                $commande = new Commande();
                $commande->setMontant($montant);
                $commande->setSize($item['size']);
                $commande->setQuantity($quantity);
                $commande->setDateEnregistrement(date('Y-m-d H:i:s'));
                $commande->setIdMembre($idMembre);
                $commande->setProductId($item['productId']);
            
                if (!$repository->saveCommand($commande)) {
                    echo json_encode(['success' => false, 'message' => 'Failed to save product with ID: ' . $item['productId']]);
                    return;
                }
            }
            

            unset($_SESSION['basket_data']);
            unset($_SESSION['basket']);
            $_SESSION['basket_count'] = 0;

            echo json_encode(['success' => true, 'message' => 'Payment processed successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    public function showPaymentPage() {
        $this->render('paymentPage.html.php', []);
    }
}
