<?php

namespace Controllers;

use Controllers\BaseController;

class CommandeController extends BaseController {
    public function getBasketData() {

        $requestData = json_decode(file_get_contents('php://input'), true);
        $basketData = [];

        foreach ($requestData['items'] as $item) {
            $basketData[] = [
                'price' => $item['price'],
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'productId' => $item['productId'],
            ];
        }

        $_SESSION['basket_data'] = $basketData;

        header('Content-Type: application/json');
        
        echo json_encode([
            'basket_data' => $_SESSION['basket_data'],
            'basket_count' => $_SESSION['basket_count'] ?? 0
        ]);
        exit;
    }
}
