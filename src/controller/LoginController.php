<?php

class LoginController 
{

    public function login($controller, $bdd)
    {
        require __DIR__ . "../../../templates/login.php";
    }

    public function register($controller, $bdd)
    {
        require __DIR__ . "../../../templates/register.php";
    }
}
?>