<?php

namespace Models\entity;

class Commande extends BaseEntity {

    private $montant;
    private $date_enregistrement;
    private $id_membre;

    public function getMontant() {
        return $this->montant;
    }

    public function setMontant($montant) {
        $this->montant = $montant;
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
}
