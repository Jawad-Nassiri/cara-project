<?php

namespace Models\entity;

class Product extends BaseEntity {
    private string $categorie;
    private string $titre;
    private string $marque;
    private string $description;
    private string $public;
    private string $photo;
    private float $prix;
    private int $stock;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

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

    public function getCategorie(): string {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): void {
        $this->categorie = $categorie;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getPublic(): string {
        return $this->public;
    }

    public function setPublic(string $public): void {
        $this->public = $public;
    }

    public function getPhoto(): string {
        return $this->photo;
    }

    public function setPhoto(string $photo): void {
        $this->photo = $photo;
    }

    public function getPrix(): float {
        return $this->prix;
    }

    public function setPrix(float $prix): void {
        $this->prix = $prix;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }
}
