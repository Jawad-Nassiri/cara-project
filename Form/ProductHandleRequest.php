<?php

namespace Form;

use Models\entity\Product;

class ProductHandleRequest extends BaseHandleRequest {

    public function handleProductRequest(Product $product) {
        if ($this->isSubmitted()) {
            $errors = $this->validateForm();

            if (empty($errors)) {
                $product->setCategorie($_POST['categorie']);
                $product->setTitre($_POST['titre']);
                $product->setMarque($_POST['marque']);
                $product->setDescription($_POST['description']);
                $product->setPublic($_POST['public']);
                $product->setPrix($_POST['prix']);
                $product->setStock($_POST['stock']);

                return $product;
            } else {
                $this->setErrorsForm($errors);
            }
        }
        return null;
    }

    private function validateForm() {
        $errors = [];

        if (empty($_POST['categorie'])) {
            $errors['categorie'] = "Category is required.";
        }

        if (empty($_POST['titre'])) {
            $errors['titre'] = "Title is required.";
        }

        if (empty($_POST['marque'])) {
            $errors['marque'] = "Brand is required.";
        }

        if (empty($_POST['description'])) {
            $errors['description'] = "Description is required.";
        }

        
        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== 0) {
            $errors['photo'] = "Photo is required.";
        }

        if (empty($_POST['prix'])) {
            $errors['prix'] = "Price is required.";
        }

        if (empty($_POST['stock'])) {
            $errors['stock'] = "Stock is required.";
        }

        return $errors;
    }
}
