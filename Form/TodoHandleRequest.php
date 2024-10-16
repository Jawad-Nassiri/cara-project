<?php

namespace Form;

use Models\entity\Contact;

class TodoHandleRequest extends BaseHandleRequest
{
    public function handleRequest(Contact $contact)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (empty($_POST['name'])) {
                $errors['name'] = 'Name is required.';
            }
            
            
            if (empty($_POST['email'])) {
                $errors['email'] = 'Email is required.';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format.';
            }

            
            if (empty($_POST['subject'])) {
                $errors['subject'] = 'Subject is required.';
            }


            if (empty($_POST['message'])) {
                $errors['message'] = 'Message cannot be empty.';
            }


            if(empty($errors)){
                $contact->setName($_POST['name']);
                $contact->setEmail($_POST['email']);
                $contact->setSubject($_POST['subject']);
                $contact->setMessage($_POST['message']);

                return $contact;
            }else {
                $this->setErrorsForm($errors);
            }
        }
    }
}
