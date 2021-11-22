<?php
require 'class/NavBar.php';

$navbar = new NavBar();

$navbar->generate($navbar->beginNavBar());
$navbar->generate($navbar->beginNavItems());

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

if ($pathInfo === '/') {
    $navbar->generate($navbar->navItem(true, "Comptes"));
    $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    $navbar->generate($navbar->navItem(false, "Profil", "profil"));
} elseif ($pathInfo === '/analyse') {
    $navbar->generate($navbar->navItem(false, "Comptes"));
    $navbar->generate($navbar->navItem(true, "Analyse", "analyse"));
    $navbar->generate($navbar->navItem(false, "Profil", "profil"));
} elseif ($pathInfo === '/profil') {
    $navbar->generate($navbar->navItem(false, "Comptes"));
    $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    $navbar->generate($navbar->navItem(true, "Profil", "profil"));
}

$navbar->generate($navbar->endNavItems());
$navbar->generate($navbar->endNavBar());