<?php

namespace Controllers;

use Models\entity\Product;
use Models\repository\AdminRepository;
use Form\ProductHandleRequest;
use Models\repository\Sign_InRepository;

class AdminAddProductController extends BaseController {
    private $adminRepo;

    public function __construct()
    {
        $this->adminRepo = new AdminRepository();
    }
    
    public function showAddProductForm(){
        $this->checkAdminAccess();
        $products = $this->showAllProducts();
        $users = (new Sign_InRepository())->getAllUsers();  // Fetch users
        return $this->render('admin-add-product.html.php', [
            'products' => $products,
            'users' => $users,  // Pass users to the view
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


    // Editing the product from the admin list when the admin click on the  edit btn
    public function editProduct($id) {
        $this->checkAdminAccess();
    
        $product = $this->adminRepo->getProductByIdForAdmin($id);
    
        if ($product) {
            $handler = new ProductHandleRequest();
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                                    $product->setPhoto($fileName);  // Set the new photo if uploaded
                                } else {
                                    $handler->setErrorsForm(['photo' => 'Error uploading the photo.']);
                                }
                            } else {
                                $handler->setErrorsForm(['photo' => 'File size exceeds the 5MB limit.']);
                            }
                        } else {
                            $handler->setErrorsForm(['photo' => 'Invalid file type. Only jpg, jpeg, png, and gif are allowed.']);
                        }
                    }
    
                    
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
    
            return $this->render('admin-edit-product.html.php', [
                'product' => $product,
                'errors' => $handler->getErrorsForm() ?? [],
            ]);
        } else {
            echo "Product not found.";
        }
    }


    // Delete a User From The User List By Admin  
    public function deleteUser(){

        if (isset($_POST['id'])) {
            // (int) is a type cast in PHP. It converts the value of $_POST['id'] to an integer 
            $userId = (int) $_POST['id'];
            
            $userRepo = new Sign_InRepository();
            
            $isDeleted = $userRepo->deleteUserById($userId);
            
            if ($isDeleted) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error deleting user']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User ID not provided']);
        }
    }

    // Editing the user account from the admin list when the admin click on the  edit btn
    public function editUserAccount($userId) {
        $userId = (int) $_GET['userId'];
        
    
        $userRepo = new Sign_InRepository();
        
        $user = $userRepo->getUserById($userId);
    
        if ($user) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $statutAdmin = $_POST['statut_admin'];
    
                $updateSuccess = $userRepo->updateUserById($userId, $username, $email, $statutAdmin);
    
                if ($updateSuccess) {
                    header('Location: /project%20final%20de%20poles/AdminAddProduct/showAddProductForm#user-list');
                    exit;
                } else {
                    echo "Error updating user.";
                }
            }
    
            return $this->render('AdminEditUserAccount.html.php', [
                'user' => $user
            ]);
        } else {
            echo "User not found.";
        }
    }
    
}
