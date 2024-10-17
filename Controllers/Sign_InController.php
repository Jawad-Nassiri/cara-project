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

        
        if ($this->signInRequest->handleSignInRequest()) {

            header("Location: /project%20final%20de%20poles/product/index");
            exit;
        }

        $errors = $this->signInRequest->getErrorsForm();
        return $this->renderSignInForm($errors);
    }

    private function renderSignInForm($errors = [])
    {
        $this->render('sign-in-form.html.php', ['errors' => $errors]);
    }
}
