<?php


namespace Models\entity;

class Sign_Up extends BaseEntity {

    private $username;
    private $email;
    private $password;

    private $staut_admin;

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    public function getAdminStatus(){
        return $this->staut_admin;
    }

    public function setAdminStatus($staut_admin){
        $this->staut_admin = $staut_admin;
    }
}