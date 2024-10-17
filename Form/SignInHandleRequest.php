<?php

namespace Form;


use Models\repository\Sign_InRepository;

class SignInHandleRequest extends BaseHandleRequest {

    private $repository;

    public function __construct(Sign_InRepository $repository) {
        $this->repository = $repository;
    }

    public function handleSignInRequest() {
        if ($this->isSubmitted()) {
            $errors = [];

            if (empty($_POST['username'])) {
                $errors['username'] = "Username is required.";
            }

            if (empty($_POST['password'])) {
                $errors['password'] = "Password is required.";
            }

            if (empty($errors)) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $user = $this->repository->getUserByUsername($username);

                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        return true;
                    } else {
                        $errors['password'] = "Incorrect password.";
                    }
                } else {
                    $errors['username'] = "Username not found.";
                }
            }

            $this->setErrorsForm($errors);
            return false;
        }
    }
}
