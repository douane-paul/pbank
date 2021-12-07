<?php

class HomeController 
{
    public function home($currentRequest, $bdd)
    {
        require __DIR__ . "../../../templates/home.php";
    }

    public function showTransactionsByBank($currentRequest, $bdd)
    {
        require __DIR__ . "../../../templates/showTransactionByBank.php";
    }

    public function showTransactions($currentRequest, $bdd)
    {
        require __DIR__ . "../../../templates/showTransactions.php";
    }
}
?>