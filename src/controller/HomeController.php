<?php
namespace App\Controller;

class HomeController 
{
    public function home($currentRequest)
    {
        require __DIR__ . "../../../templates/home.php";
    }
}
?>