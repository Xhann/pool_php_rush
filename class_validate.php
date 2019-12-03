<?php
class Validate
{
    public function validateName($name) : bool
    {
        return preg_match("#^[a-zA-Z0-9_]{3,10}$#", $name);
    }
    public function validatePassword($password) : bool
    {
        return preg_match("#^[a-zA-Z0-9_]{3,10}$#", $password);
    }
    public function validatePasswordConfirmation($password, $passwordConfirm) : bool
    {
        return $password===$passwordConfirm;
    }
    public function validateMail($email) :bool
    {
        return preg_match("#^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$#", $email);
    }
}
