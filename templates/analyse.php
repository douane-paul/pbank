<?php 

require 'class\Html.php';
require 'class\Auth.php';

$login = new Auth;

$login->authenticate();

$html = new Html();
session_start();


$html->generate($html->header());
$html->generate($html->beginBody());

include 'navbar.php';

$html->generate($html->endBody());
?>