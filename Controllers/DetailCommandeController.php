<?php

namespace Controllers;

use Models\entity\DetailCommande;
use Models\repository\DetailCommandeRepository;

class DetailCommandeController extends BaseController {

    public function saveDetailCommande($commandeId, $items) {
        $detailCommandeRepository = new DetailCommandeRepository();

        foreach ($items as $item) {
            
            $detailCommande = new DetailCommande();
            $detailCommande->setCommandeId($commandeId);
            $detailCommande->setProductId($item['productId']);
            $detailCommande->setSize($item['size']);
            $detailCommande->setQuantity($item['quantity']);
            
            if (!$detailCommandeRepository->saveDetailCommande($detailCommande)) {
                echo json_encode(['success' => false, 'message' => 'Failed to save detail command']);
                return;
            }
        }

        echo json_encode(['success' => true, 'message' => 'Detail command saved successfully']);
    }

    public function getDetailsByCommandeId($commandeId) {
        $detailCommandeRepository = new DetailCommandeRepository();
        $details = $detailCommandeRepository->getDetailsByCommandeId($commandeId);

        echo json_encode([
            'success' => true,
            'details' => $details
        ]);
    }
}
