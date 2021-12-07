<?php
require 'class\NavBar.php';

$navbar = new NavBar();

$navbar->generate($navbar->beginNavBar());
$navbar->generate($navbar->beginNavItems());

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

if ($pathInfo === '/') {
    if (isset($_SESSION['session_id'])) 
    {
        $navbar->generate($navbar->navItem(true, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
        $navbar->generate($navbar->navItem(false, "Profil", "profil"));
        $navbar->generate($navbar->navItem(false, "Ajouter une banque", "banque"));
        $navbar->generate($navbar->navItem(false, "Ajouter une transaction", "transaction"));
        $navbar->generate($navbar->navItem(false, "Deconnexion", "logout"));
    } 
    else 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    }
} elseif ($pathInfo === '/analyse') {
    if (isset($_SESSION['session_id'])) 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(true, "Analyse", "analyse"));
        $navbar->generate($navbar->navItem(false, "Profil", "profil"));
        $navbar->generate($navbar->navItem(false, "Ajouter une banque", "banque"));
        $navbar->generate($navbar->navItem(false, "Ajouter une transaction", "transaction"));
        $navbar->generate($navbar->navItem(false, "Deconnexion", "logout"));
    } 
    else 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    }
} elseif ($pathInfo === '/profil') {
    if (isset($_SESSION['session_id'])) 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
        $navbar->generate($navbar->navItem(true, "Profil", "profil"));
        $navbar->generate($navbar->navItem(false, "Ajouter une banque", "banque"));
        $navbar->generate($navbar->navItem(false, "Ajouter une transaction", "transaction"));
        $navbar->generate($navbar->navItem(false, "Deconnexion", "logout"));
    } 
    else 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    }
} elseif ($pathInfo === '/banque') {
    if (isset($_SESSION['session_id'])) 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
        $navbar->generate($navbar->navItem(false, "Profil", "profil"));
        $navbar->generate($navbar->navItem(true, "Ajouter une banque", "banque"));
        $navbar->generate($navbar->navItem(false, "Ajouter une transaction", "transaction"));
        $navbar->generate($navbar->navItem(false, "Deconnexion", "logout"));
    } 
    else 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    }
} elseif ($pathInfo === '/transaction') {
    if (isset($_SESSION['session_id'])) 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
        $navbar->generate($navbar->navItem(false, "Profil", "profil"));
        $navbar->generate($navbar->navItem(false, "Ajouter une banque", "banque"));
        $navbar->generate($navbar->navItem(true, "Ajouter une transaction", "transaction"));
        $navbar->generate($navbar->navItem(false, "Deconnexion", "logout"));
    } 
    else 
    {
        $navbar->generate($navbar->navItem(false, "Comptes"));
        $navbar->generate($navbar->navItem(false, "Analyse", "analyse"));
    }
}

$navbar->generate($navbar->endNavItems());
$navbar->generate($navbar->endNavBar());