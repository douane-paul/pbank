<?php

class TransactionController 
{
    public function transaction($currentRequest, $bdd)
    {
        require __DIR__ . "../../../templates/transaction.php";
    }
}
?>