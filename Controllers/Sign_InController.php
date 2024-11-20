<?php

namespace Controllers;

use Models\repository\Sign_InRepository;
use Form\SignInHandleRequest;

class Sign_InController extends BaseController
{
    private $signInRequest;

    public function signIn()
    {
        
        $repository = new Sign_InRepository();
        $this->signInRequest = new SignInHandleRequest($repository);


        $user = $this->signInRequest->handleSignInRequest();

        if($user){

            $_SESSION['username'] = $user['username'];
            $_SESSION['statut_admin'] = $user['statut_admin'];
            // header("Location: /project%20final%20de%20poles/product/index");

            if ($_SESSION['statut_admin'] == 1) {
                header("Location: /project%20final%20de%20poles/product/index");
            } else {
                header("Location: /project%20final%20de%20poles/product/index");
            }

            exit;
        }
        

        $errors = $this->signInRequest->getErrorsForm();
        return $this->renderSignInForm($errors);
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /project%20final%20de%20poles/product/index');
        exit();
    }

    private function renderSignInForm($errors = [])
    {
        $this->render('sign-in-form.html.php', ['errors' => $errors]);
    }
}
