<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;

class CommandeController extends BaseController {


    public function saveBasket() {
        if (!isset($_SESSION['username'])) {
            echo json_encode(['isNotLogged' => 'You need to log in to complete the order.']);
            return;
        }

        $userId = $_SESSION['user_id'];
        
        $data = json_decode(file_get_contents('php://input'), true);
        error_log("Incoming Basket Data: " . print_r($data, true));
        die('ok');  

        if ($data && isset($data['basket'])) {

            $basket = $data['basket'];
            $commandeRepo = new CommandeRepository();

            $errors = [];
            foreach ($basket as $item) {
                try {
                    $commande = new Commande();
                    $commande->setMontant($item['price'] * $item['quantity']);
                    $commande->setSize($item['size']);
                    $commande->setDateEnregistrement(date('Y-m-d H:i:s'));
                    $commande->setIdMembre($userId);
                    $commande->setProductId($item['id']);

                    if (!$commandeRepo->saveCommand($commande)) {
                        $errors[] = "Failed to save item with ID {$item['id']}.";
                    }
                } catch (\Exception $e) {
                    $errors[] = "Error with item ID {$item['id']}: " . $e->getMessage();
                }
            }

            if (empty($errors)) {
                echo json_encode(['success' => true, 'message' => 'Basket successfully saved.']);
            } else {
                echo json_encode(['success' => false, 'errors' => $errors]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid basket data.']);
        }
    }
}
