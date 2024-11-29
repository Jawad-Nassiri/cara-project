<?php

namespace Controllers;
use Controllers\BaseController;
class BasketController extends BaseController {

    public function addToBasket() {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $productId = $data['id'];
            $productPhoto = $data['photo'];
            $productName = $data['name'];
            $productPrice = $data['price'];

            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }

            $_SESSION['basket'][] = [
                'id' => $productId,
                'photo' => $productPhoto,
                'name' => $productName,
                'price' => $productPrice
            ];

            echo json_encode(['message' => 'Product added to basket!']);
        } else {
            echo json_encode(['message' => 'Invalid product data']);
        }

    }


    // Basket Page Method
    public function basket() {
        $basket = isset($_SESSION['basket']) ? $_SESSION['basket'] : [];

        $this->render('basket.html.php', ['basket' => $basket]);
    }
}