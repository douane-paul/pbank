<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/controller/HomeController.php";
require __DIR__ . "/src/controller/AnalyseController.php";
require __DIR__ . "/src/controller/ProfilController.php";
require __DIR__ . "/src/controller/LoginController.php";
require __DIR__ . "/src/controller/LogOutController.php";
require __DIR__ . "/src/controller/BankController.php";
require __DIR__ . "/src/controller/TransactionController.php";

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Dotenv\Dotenv;

session_start();

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$bdd = new PDO($_ENV['DB_DNS'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$routeCollection = new RouteCollection();

addRoute($routeCollection);

$context = new RequestContext();
$matcher = new UrlMatcher($routeCollection, $context);

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

try{
    $currentRequest = $matcher->match($pathInfo);
    $page = $currentRequest['_route'];
    $controller = $currentRequest['controller'];
    call_user_func($controller, $currentRequest, $bdd);
} 
catch(ResourceNotFoundException $e){
    require "templates/404.php";
}

function addRoute($routeCollection)
{
    $homeController = new HomeController();
    $home = new Route('/', [
        'controller' => [
            $homeController,
            "home"
        ]
    ]);
    
    $analyse = new Route('/analyse', [
        'controller' => [
            new AnalyseController(),
            "analyse"
        ]
    ]);

    $profil = new Route('/profil', [
        'controller' => [
            new ProfilController(),
            "profil"
        ]
    ]);
    
    $login = new Route('/login', [
        'controller' => [
            new LoginController(),
            "login"
        ]
    ]);
    
    $register = new Route('/register', [
        'controller' => [
            new LoginController(),
            "register"
        ]
    ]);

    $deconnect = new Route('/logout', [
        'controller' => [
            new LogOutController(),
            "logout"
        ]
    ]);

    $bank = new Route('/banque', [
        'controller' => [
            new BankController(),
            "add"
        ]
    ]);
    
    $transaction = new Route('/transaction', [
        'controller' => [
            new TransactionController(),
            "transaction"
        ]
    ]);

    $showTransactionsByBank = new Route('/show/{id}', [
        'controller' => [
            $homeController,
            "showTransactionsByBank"
        ]
    ]);

    $showTransactions = new Route('/show/{id}/transaction/{id2}', [
        'controller' => [
            $homeController,
            "showTransactions"
        ]
    ]);

    $routeCollection->add('home', $home);
    $routeCollection->add('analyse', $analyse);
    $routeCollection->add('login', $login);
    $routeCollection->add('register', $register);
    $routeCollection->add('profil', $profil);
    $routeCollection->add('logout', $deconnect);
    $routeCollection->add('banque', $bank);
    $routeCollection->add('transaction', $transaction);
    $routeCollection->add('showTransactionsByBank', $showTransactionsByBank);
    $routeCollection->add('showTransactions', $showTransactions);
}