<?php

namespace Models\entity;

class DetailCommande extends BaseEntity {

    private $commande_id;
    private $product_id;
    private $size;
    private $quantity;

    public function getCommandeId() {
        return $this->commande_id;
    }

    public function setCommandeId($commandeId) {
        $this->commande_id = $commandeId;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function setProductId($productId) {
        $this->product_id = $productId;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}
