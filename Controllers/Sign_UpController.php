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
    public function submitSign_UpForm()
    {
        $formHandler = new SignUpHandleRequest();
        $formHandler->handleSignUpRequest($this->sign_up);

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $this->saveFormData($_POST);

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

    private function saveFormData($formData)
    {
        $Sign_UpRepo = new Sign_UpRepository();

        if ($Sign_UpRepo->saveSign_UpForm($formData)) {
            echo 'Your message has been sent successfully!';
        } else {
            echo 'There was an error sending your message. Please try again.';
        }
    }
}







/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


// namespace Controllers;

// use Controllers\BaseController;
// use Form\SignUpHandleRequest;
// use Models\entity\Sign_Up;
// use Models\repository\Sign_UpRepository;

// class Sign_UpController extends BaseController
// {
//     private Sign_Up $sign_up;

//     public function __construct()
//     {
//         $this->sign_up = new Sign_Up;
//     }

//     public function submitSign_UpForm()
//     {
//         $formHandler = new SignUpHandleRequest();
//         $formHandler->handleSignUpRequest($this->sign_up);

//         if ($formHandler->isSubmitted()) {
//             if ($formHandler->isValid()) {
//                 $this->saveFormData($_POST);

//                 $_SESSION['username'] = $this->sign_up->getUsername();

//                 header('Location: /project%20final%20de%20poles/product/index');
//                 exit();
//             } else {
//                 $errors = $formHandler->getErrorsForm();

//                 $_POST = [];

//                 return $this->render('sign-up-form.html.php', [
//                     'errors' => $errors,  
//                     'username' => '',  
//                     'email' => '',        
//                     'password' => ''     
//                 ]);
//             }
    


//         return $this->render('sign-up-form.html.php', [
//             'username' => '',
//             'email' => '',
//             'password' => '',
//             'errors' => []
//         ]);
//     }

//     private function saveFormData($formData)
//     {
//         $Sign_UpRepo = new Sign_UpRepository();

//         if ($Sign_UpRepo->saveSign_UpForm($formData)) {
//             echo 'Your message has been sent successfully!';
//         } else {
//             echo 'There was an error sending your message. Please try again.';
//         }
//     }
// }