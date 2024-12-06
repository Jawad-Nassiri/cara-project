<?php

namespace Controllers;

use Models\entity\Product;
use Models\repository\AdminRepository;
use Form\ProductHandleRequest;

class AdminAddProductController extends BaseController
{
    private $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
    }
    public function showAddProductForm()
    {
        $this->checkAdminAccess();
        $products = $this->showAllProducts();
        return $this->render('admin-add-product.html.php', [
            'products' => $products,
        ]);
    }

    public function addProduct() {
        $this->checkAdminAccess();
    
        if (isset($_POST['submit'])) {
            $product = new Product();
            $handler = new ProductHandleRequest();
    
            $product = $handler->handleProductRequest($product);
    
            if ($product && $handler->isValid()) {
    
                if ($_FILES['photo']['error'] === 0) {
                    $targetDir = __DIR__ . '/../public/assets/images/products/';
                    $fileName = basename($_FILES["photo"]["name"]);
                    $targetFile = $targetDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
                    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        if ($_FILES['photo']['size'] <= 5000000) { 
                            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                                $product->setPhoto($fileName); 
                            } else {
                                $handler->setErrorsForm(['photo' => 'Error uploading the photo.']);
                            }
                        } else {
                            $handler->setErrorsForm(['photo' => 'File size exceeds the 5MB limit.']);
                        }
                    } else {
                        $handler->setErrorsForm(['photo' => 'Invalid file type. Only jpg, jpeg, png, and gif are allowed.']);
                    }
                } else {
                    $handler->setErrorsForm(['photo' => 'Photo is required.']);
                }
    
                if ($handler->isValid()) {
                    $isProductAdded = $this->adminRepo->addProductForAdmin(
                        $product->getCategorie(),
                        $product->getTitre(),
                        $product->getMarque(),
                        $product->getDescription(),
                        $product->getPublic(),
                        $product->getPhoto(),
                        $product->getPrix(),
                        $product->getStock()
                    );
    
                    if ($isProductAdded) {
                        header("Location: /project%20final%20de%20poles/");
                        exit();
                    } else {
                        $handler->setErrorsForm(['general' => 'There was an error adding the product.']);
                    }
                }
            }
    
            $this->render('admin-add-product.html.php', ['errors' => $handler->getErrorsForm()]);
        }
    }
    

    private function checkAdminAccess()
    {
        if (!isset($_SESSION['statut_admin']) || $_SESSION['statut_admin'] !== 1) {
            header("Location: /project%20final%20de%20poles/product/index");
            exit();
        }
    }


    public function showAllProducts()
    {
        $this->checkAdminAccess();

        $products = $this->adminRepo->getAllProductsForAdmin();

        return $products;
    }


    // Removing the product from the admin list when the admin click on the delete button
    public function deleteProduct($id)
    {
        $this->checkAdminAccess();

        $product = $this->adminRepo->getProductByIdForAdmin($id);

        if ($product) {
            $imagePath = __DIR__ . '/../public/assets/images/products/' . $product->getPhoto();

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $isDeleted = $this->adminRepo->deleteProductForAdmin($id);

            if ($isDeleted) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Product could not be deleted from the database.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
        }
    }


    // Editing the product from the admin list when the admin click on the delete edit
    public function editProduct($id) {
        $this->checkAdminAccess();
    
        // Fetch the product by its ID
        $product = $this->adminRepo->getProductByIdForAdmin($id);
    
        if ($product) {
            $handler = new ProductHandleRequest();
    
            // If the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle the form data and validate (except for the photo)
                $product = $handler->handleProductRequest($product);
    
                // Check if there are no validation errors
                if ($product && $handler->isValid()) {
                    // Handle the photo separately (if uploaded)
                    if ($_FILES['photo']['error'] === 0) {
                        $targetDir = __DIR__ . '/../public/assets/images/products/';
                        $fileName = basename($_FILES["photo"]["name"]);
                        $targetFile = $targetDir . $fileName;
                        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
                        if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                            if ($_FILES['photo']['size'] <= 5000000) {
                                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                                    $product->setPhoto($fileName);  // Set the new photo if uploaded
                                } else {
                                    // Set an error if uploading fails
                                    $handler->setErrorsForm(['photo' => 'Error uploading the photo.']);
                                }
                            } else {
                                $handler->setErrorsForm(['photo' => 'File size exceeds the 5MB limit.']);
                            }
                        } else {
                            $handler->setErrorsForm(['photo' => 'Invalid file type. Only jpg, jpeg, png, and gif are allowed.']);
                        }
                    }
    
                    // If there are no errors, update the product
                    if ($handler->isValid()) {
                        $isProductUpdated = $this->adminRepo->editProductForAdmin(
                            $product->getId(),
                            $product->getCategorie(),
                            $product->getTitre(),
                            $product->getMarque(),
                            $product->getDescription(),
                            $product->getPublic(),
                            $product->getPhoto(),
                            $product->getPrix(),
                            $product->getStock()
                        );
    
                        if ($isProductUpdated) {
                            header("Location: /project%20final%20de%20poles/AdminAddProduct/showAddProductForm");
                            exit();
                        } else {
                            $handler->setErrorsForm(['general' => 'There was an error updating the product.']);
                        }
                    }
                }
            }
    
            // Render the product edit form with any errors
            return $this->render('admin-edit-product.html.php', [
                'product' => $product,
                'errors' => $handler->getErrorsForm() ?? [],
            ]);
        } else {
            echo "Product not found.";
        }
    }
    
    
}
