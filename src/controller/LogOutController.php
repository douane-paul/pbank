<?php

class LogOutController 
{
    public function logout($currentRequest)
    {
        require __DIR__ . "../../../templates/logout.php";
    }
}
?>