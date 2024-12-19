<?php

namespace Models\entity;

class Commande extends BaseEntity {

    private $montant;
    private $size;
    private $quantity;
    private $date_enregistrement;
    private $id_membre;
    private $product_id;

    public function getMontant() {
        return $this->montant;
    }

    public function setMontant($montant) {
        $this->montant = $montant;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize( $size) {
        $this->size = $size;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getDateEnregistrement() {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement($date) {
        $this->date_enregistrement = $date;
    }

    public function getIdMembre() {
        return $this->id_membre;
    }

    public function setIdMembre($idMembre) {
        $this->id_membre = $idMembre;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function setProductId($productId) {
        $this->product_id = $productId;
    }
}
