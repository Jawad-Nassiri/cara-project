<?php

namespace Models\entity;

class Product extends BaseEntity {
    private string $titre;
    private string $marque; 
    private float $prix;

    public function getTitre(): string {
        return $this->titre;
    }

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function getMarque(): string {
        return $this->marque;
    }

    public function setMarque(string $marque): void {
        $this->marque = $marque;
    }

    public function getPrix(): float {
        return $this->prix;
    }

    public function setPrix(float $prix): void {
        $this->prix = $prix;
    }
}

