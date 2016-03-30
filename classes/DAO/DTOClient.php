<?php

/**
 * DTO => Data Transfert Object, pourrait aussi être dénommé entity
 */

class DTOClient {

    private $email;
    private $id;
    private $password;
    private $plainPassword;

    public function getEmail() {
        return $this->email;
    }

    public function getId() {
        return $this->id;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }

}
