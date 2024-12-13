<?php

namespace Controllers;

use Models\entity\Commande;
use Models\repository\CommandeRepository;

class PaymentController extends BaseController {

    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve cart data from session
            $cartData = $_SESSION['cartData'] ?? null;
            $idMembre = $_SESSION['user_id'] ?? null;
    
            // Check if cart data or user ID is missing
            if (!$cartData || !$idMembre) {
                echo json_encode(['success' => false, 'message' => 'No cart data or user not logged in.']);
                return;
            }
    
            $repository = new CommandeRepository();
    
            // Loop through each item in the cart
            foreach ($cartData as $index => $item) {
                // Check if all required keys exist
                if (!isset($item['price'], $item['quantity'], $item['size'], $item['productId'])) {
                    echo json_encode(['success' => false, 'message' => 'Missing required item data (price, quantity, size, or productId) in item ' . $index]);
                    return;
                }
    
                // Check price processing
                $price = $item['price'];
                $cleanPrice = str_replace(['€', ' ', ','], '', $price);  // Remove € symbol and spaces
                $priceFloat = floatval($cleanPrice);  // Convert to float
    
                // Log price processing
                var_dump($price, $cleanPrice, $priceFloat);  // Debugging log
    
                // Ensure quantity is an integer
                $quantity = (int) $item['quantity']; // Ensure quantity is an integer
    
                // Check if quantity is valid
                if ($quantity <= 0) {
                    echo json_encode(['success' => false, 'message' => 'Invalid quantity for product ID: ' . $item['productId']]);
                    return;
                }
    
                // Calculate the total amount for this item
                $montant = $priceFloat * $quantity;
    
                // Check if montant (total) is a valid positive number
                if ($montant <= 0) {
                    echo json_encode(['success' => false, 'message' => 'Invalid amount for product ID: ' . $item['productId']]);
                    return;
                }
    
                // Create the Commande object and set its properties
                $commande = new Commande();
                $commande->setMontant($montant);  // Set the calculated total price
                $commande->setSize($item['size']);  // Set the size
                $commande->setDateEnregistrement(date('Y-m-d H:i:s')); // Set the current timestamp for order date
                $commande->setIdMembre($idMembre); // Associate the order with the user ID
                $commande->setProductId($item['productId']); // Set the product ID
    
                // Attempt to save the order in the database
                $success = $repository->saveCommand($commande);
                if (!$success) {
                    echo json_encode(['success' => false, 'message' => 'Failed to save product with ID: ' . $item['productId']]);
                    return;
                }
            }
    
            // Clear the cart data from session after processing payment
            unset($_SESSION['cartData']); 
    
            // Return success response after all orders have been saved
            echo json_encode(['success' => true, 'message' => 'Payment processed successfully.']);
        } else {
            // Handle invalid request method (not POST)
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }
    
}
