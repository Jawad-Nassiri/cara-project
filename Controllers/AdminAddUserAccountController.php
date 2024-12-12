<?php

namespace Controllers;

use Controllers\BaseController;
use Form\AdminAddUserAccountHandleRequest;
use Models\entity\Sign_Up;
use Models\repository\Sign_UpRepository;

class AdminAddUserAccountController extends BaseController
{
    private Sign_Up $sign_up;

    public function __construct()
    {
        $this->sign_up = new Sign_Up;
    }

    public function addUserForm()
    {
        $formHandler = new AdminAddUserAccountHandleRequest();
        $formHandler->handleAdminUserRequest($this->sign_up);
        
        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {

                $this->saveFormData($this->sign_up);

                $_SESSION['username'] = $this->sign_up->getUsername();

                header('Location: /project%20final%20de%20poles/AdminAddProduct/showAddProductForm#user-list');
                exit();
            } else {
                $errors = $formHandler->getErrorsForm();
                foreach ($errors as $field => $error) {
                    echo "$field: $error<br>";
                }
            }
        }

        return $this->render('admin-add-product.html.php');
    }

    private function saveFormData(Sign_Up $sign_up){
        
        $signUpRepo = new Sign_UpRepository();

        if ($signUpRepo->saveSign_UpForm($sign_up)) {
            header('Location: /project%20final%20de%20poles/AdminAddProduct/showAddProductForm#user-list');
        } else {
            echo 'There was an error during user creation. Please try again.';
        }
    }
}
