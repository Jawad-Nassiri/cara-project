<?php

namespace Controllers;

class CommandeController extends BaseController {

    public function getProductData() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputData = file_get_contents('php://input');
            $cartData = json_decode($inputData, true);
        
            $_SESSION['cartData'] = $cartData;
        
            echo json_encode(['success' => true , 'cartData' => $cartData]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
        }
    }

}


