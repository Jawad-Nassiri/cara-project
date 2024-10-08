<?php

namespace Controllers;


use Models\repository\ProductRepository;

class ProductController extends BaseController {
    
    public function index() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAllProducts();

        $this->render('home.html.php', $products);
    }
}

