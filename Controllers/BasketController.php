<?php

namespace Controllers;
use Controllers\BaseController;
class BasketController extends BaseController {

    public function addToBasket() {

        if (!isset($_SESSION['username'])) {
            echo json_encode(['isNotLogged' => 'You need to create an account to add products to the basket.']);
            return;
        }


        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $productId = $data['id'];
            $productPhoto = $data['photo'];
            $productName = $data['name'];
            $productPrice = $data['price'];
    
            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }
    
             // Check if product already exists in the basket
            $productExists = false;
            foreach ($_SESSION['basket'] as &$item) {
                if ($item['id'] == $productId) {
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                $_SESSION['basket'][] = [
                    'id' => $productId,
                    'photo' => $productPhoto,
                    'name' => $productName,
                    'price' => $productPrice
                ];
            }
            echo json_encode(['message' => 'Product added to basket']);
        }else {
            echo json_encode(['message' => 'Invalid product data']);
        }

    }

        // Removing the product from the basket after the remove icon is clicked 
        public function removeFromBasket() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
    
                if (isset($data['id']) && isset($_SESSION['basket'])) {
                    $productId = $data['id'];
    
                    $_SESSION['basket'] = array_filter($_SESSION['basket'], function($item) use ($productId) {
                        return $item['id'] != $productId;
                    });
    
                    $_SESSION['basket'] = array_values($_SESSION['basket']);
    
                    echo json_encode(['success' => true, 'message' => 'Product removed from basket']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Product not found in basket']);
                }
            }
        }

    
    // Basket Page Method
    public function basket() {
        $basket = isset($_SESSION['basket']) ? $_SESSION['basket'] : [];

        $this->render('basket.html.php', ['basket' => $basket]);
    }

}