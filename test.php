<?php

require 'inc/autoload.php'; // Adjust path as necessary

use Models\entity\Product;

$product = new Product();
$product->setTitre('Test Product');
echo $product->getTitre(); // Should output "Test Product"
