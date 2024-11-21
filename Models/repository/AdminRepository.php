<?php

namespace Models\repository;

class AdminRepository extends BaseRepository {

    public function addProductForAdmin($categorie, $titre, $marque, $description, $public, $photo, $prix, $stock) {
        return $this->addProduct($categorie, $titre, $marque, $description, $public, $photo, $prix, $stock);
    }

    public function deleteProductForAdmin($id) {
        return $this->deleteProduct($id);
    }

    public function getAllProductsForAdmin() {
        return $this->findAll('product');
    }

    public function getProductByIdForAdmin($id) {
        return $this->findProductById($id);
    }
}
