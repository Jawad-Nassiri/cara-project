<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;
use Controllers\DetailCommandeController;

class PaymentController extends BaseController {
    private $detailCommandeController;

    public function __construct() {
        $this->detailCommandeController = new DetailCommandeController();
    }

    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            return;
        }

        $basket = $_SESSION['basket_data'] ?? null;
        $idMembre = $_SESSION['user_id'] ?? null;

        if (!$basket || !$idMembre) {
            echo json_encode(['success' => false, 'message' => 'Basket data or user ID missing']);
            return;
        }

        $totalAmount = 0;
        foreach ($basket as $item) {
            $price = preg_replace('/[^\d.]/', '', $item['price']);
            $priceFloat = floatval($price);
            $quantity = (int) $item['quantity'];
            $totalAmount += $priceFloat * $quantity;
        }

        $repository = new CommandeRepository();
        $commande = new Commande();
        $commande->setMontant($totalAmount);
        $commande->setDateEnregistrement(date('Y-m-d H:i:s'));
        $commande->setIdMembre($idMembre);

        if (!$repository->saveCommande($commande)) {
            echo json_encode(['success' => false, 'message' => 'Failed to save the command']);
            return;
        }

        $commandeId = $commande->getId();

        $this->detailCommandeController->saveDetailCommande($commandeId, $basket);

        unset($_SESSION['basket_data']);
        unset($_SESSION['basket']);
        $_SESSION['basket_count'] = 0;

        echo json_encode(['success' => true, 'message' => 'Payment processed successfully.']);
    }

    public function showPaymentPage() {
        $this->render('paymentPage.html.php', []);
    }
}