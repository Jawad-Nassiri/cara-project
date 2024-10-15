<?php




namespace Models\repository;

class ProductRepository extends BaseRepository {
    public function findAllProducts() {
        return $this->findAll('product');
    }
}