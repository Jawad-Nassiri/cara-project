<?php

namespace Controllers;

use Controllers\BaseController;
use Form\TodoHandleRequest;
use Models\entity\Contact;
use Models\repository\ContactRepository;

class ContactController extends BaseController
{
    private Contact $contact;
    public function __construct()
    {
        $this->contact = new Contact;
    }
    public function submitContactForm()
    {
        $formHandler = new TodoHandleRequest();
        $formHandler->handleRequest($this->contact);

        if ($formHandler->isSubmitted()) {
            if ($formHandler->isValid()) {
                $this->saveFormData($_POST);
                echo 'Message sent successfully!';
            } else {
                $errors = $formHandler->getErrorsForm();
                foreach ($errors as $field => $error) {
                    echo "$field: $error<br>";
                }
            }
        }

        return $this->render('contact-form.html.php');
    }

    private function saveFormData($formData)
    {
        $contactRepo = new ContactRepository();

        if ($contactRepo->saveContactForm($formData)) {
            header('Location: /project%20final%20de%20poles/product/index');
        } else {
            echo 'There was an error sending your message. Please try again.';
        }
    }
}
