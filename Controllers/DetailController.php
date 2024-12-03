<?php

namespace Controllers;

use Models\repository\AdminRepository;

class DetailController extends BaseController
{
    private $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
    }

    public function showProductDetails()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $productId = $_GET['id'];
            
            $product = $this->adminRepo->getProductByIdForAdmin($productId);

            if ($product) {
                return $this->render('details-page.html.php', [
                    'product' => $product
                ]);
            } else {
                echo "Product not found!";
                exit();
            }
        } else {
            echo "Invalid product ID!";
            exit();
        }
    }
}