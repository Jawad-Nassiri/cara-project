<?php

namespace Form;

use Models\entity\Sign_Up;

class AdminAddUserAccountHandleRequest extends BaseHandleRequest
{
    public function handleAdminUserRequest(Sign_Up $sign_up)
    {
        if ($this->isSubmitted()) {
            $errors = [];

            if (empty($_POST['username'])) {
                $errors['username'] = "Username is required.";
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "Email is required.";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }

            if (empty($_POST['password'])) {
                $errors['password'] = "Password is required.";
            } elseif (strlen($_POST['password']) < 6) {
                $errors['password'] = "Password must be at least 6 characters.";
            }

            $adminStatus = isset($_POST['status_admin']) ? $_POST['status_admin'] : 0;
            if (!in_array($adminStatus, [0, 1])) {
                $errors['status_admin'] = "Invalid admin status.";
            }

            if (empty($errors)) {
                $sign_up->setUsername($_POST['username']);
                $sign_up->setEmail($_POST['email']);
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sign_up->setPassword($hashedPassword);
                $sign_up->setAdminStatus($adminStatus);

                return $sign_up;
            } else {
                $this->setErrorsForm($errors);
            }
        }
    }
}
