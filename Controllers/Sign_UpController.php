<?php




namespace Controllers;

use Controllers\BaseController;
use Form\SignUpHandleRequest;
use Models\entity\Sign_Up;
use Models\repository\Sign_UpRepository;


class Sign_UpController extends BaseController
{
    private  Sign_Up $sign_up;
    public function __construct()
    {
        $this->sign_up = new Sign_Up;
    }
    public function sign_UpForm()
    {
        $formHandler = new SignUpHandleRequest();
        $formHandler->handleSignUpRequest($this->sign_up);

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $this->saveFormData($this->sign_up);

                $_SESSION['username'] = $this->sign_up->getUsername();
                
                
                header('Location: /project%20final%20de%20poles/product/index');
                exit();
            } else {
                $errors = $formHandler->getErrorsForm();
                foreach ($errors as $field => $error) {
                    echo "$field: $error<br>";
                }
            }
        }

        return $this->render('sign-up-form.html.php');
    }

    // private function saveFormData(Sign_Up $sign_up)
    // {
    //     $Sign_UpRepo = new Sign_UpRepository();

    //     if ($Sign_UpRepo->saveSign_UpForm($sign_up)) {
    //         echo 'You have successfully registered!';
    //     } else {
    //         echo 'There was an error during the registration process. Please try again.';
    //     }
    // }



    private function saveFormData(Sign_Up $sign_up)
{
    $Sign_UpRepo = new Sign_UpRepository();

    // Get the inserted ID
    $insertedId = $Sign_UpRepo->saveSign_UpForm($sign_up);

    if ($insertedId !== false) {
        // Set the ID on the sign_up object
        $sign_up->setId((int)$insertedId);

        // Set session variables
        $_SESSION['username'] = $sign_up->getUsername();
        $_SESSION['user_id'] = $sign_up->getId(); 

        echo 'You have successfully registered!';
        return true;
    } else {
        echo 'There was an error during the registration process. Please try again.';
        return false;
    }
}
}