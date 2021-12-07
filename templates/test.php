<?php

require 'class\Html.php';
require 'class\Auth.php';
require 'class\Data.php';
require 'class\User.php';

$data = new Data();
$users = new User();
$user = $users->getUser($bdd, $_SESSION['session_id']);

$login = new Auth;

$login->authenticate();

$html = new Html();

$html->generate($html->header());
$html->generate($html->beginBody());

include 'navbar.php';

$html->generate($html->endBody());