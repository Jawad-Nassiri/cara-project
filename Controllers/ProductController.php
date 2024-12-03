<?php

namespace Controllers;


use Models\repository\ProductRepository;

class ProductController extends BaseController {
    
    //Home Page Method
    public function index() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAllProducts();

        $this->render('home.html.php', ['products' => $products]);
    }

    
    //Shop Page Method
    public function shop() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAllProducts();

        $this->render('shop.html.php', ['products' => $products]);
    }

    //Blog Page Method
    public function blog() {
        $this->render('blog.html.php');
    }

    //About Page Method
    public function about() {
        $this->render('about.html.php');
    }

    
    // Basket Page Method
    public function basket() {
        $this->render('basket.html.php');
    }
    
}