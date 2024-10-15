<?php

namespace Controllers;


use Models\repository\ProductRepository;

class ProductController extends BaseController {
    
    public function index() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAllProducts();

        $this->render('home.html.php', [
            'products' => $products
        ]);
    }

    public function shop() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAllProducts();

        $this->render('shop.html.php', [
            'products' => $products
        ]);
    }

    public function blog() {
        $this->render('blog.html.php');
    }

    public function about() {
        $this->render('about.html.php');
    }
    
}