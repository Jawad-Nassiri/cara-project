<?php

namespace Controllers;
use Controllers\BaseController;
use Models\entity\Commande;
use Models\repository\CommandeRepository;
class BasketController extends BaseController {

    public function addToBasket() {

        if (!isset($_SESSION['username'])) {
            echo json_encode(['isNotLogged' => 'You need to create an account to add products to the basket.']);
            return;
        }


        $data = json_decode(file_get_contents('php://input'), true);
        if ($data) {
            $productId = $data['id'];
            $productSize = isset($data['size']) ? $data['size'] : 'small'; 
            $productQuantity = isset($data['quantity']) ? $data['quantity'] : 1;
            $productPhoto = $data['photo'];
            $productName = $data['name'];
            $productPrice = $data['price'];
    
            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }
    
            $productExists = false;

            foreach ($_SESSION['basket'] as &$item) {
                if ($item['id'] == $productId && $item['size'] == $productSize) {
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                $_SESSION['basket'][] = [
                    'id' => $productId,
                    'size' => $productSize,
                    'quantity' => $productQuantity,
                    'photo' => $productPhoto,
                    'name' => $productName,
                    'price' => $productPrice
                ];
            }


            $_SESSION['basket_count'] = count($_SESSION['basket']);

            echo json_encode([
                'message' => $productExists ? 'Product is already in the basket' : 'Product added to basket',
                'count' => $_SESSION['basket_count'],
                'productExists' => $productExists
            ]);
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
                    $_SESSION['basket_count'] = count($_SESSION['basket']);
    
                    echo json_encode(['success' => true, 'message' => 'Product removed from basket', 'count' => $_SESSION['basket_count']]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Product not found in basket']);
                }
            }
        }

    
    public function basket() {
        $basket = isset($_SESSION['basket']) ? $_SESSION['basket'] : [];

        $this->render('basket.html.php', ['basket' => $basket]);
    }

}