<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/controller/HomeController.php";
require __DIR__ . "/src/controller/AnalyseController.php";
require __DIR__ . "/src/controller/ProfilController.php";

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$home = new Route('/', [
    'controller' => [
        new HomeController(),
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

$routeCollection = new RouteCollection();
$routeCollection->add('home', $home);
$routeCollection->add('analyse', $analyse);
$routeCollection->add('profil', $profil);

$context = new RequestContext();
$matcher = new UrlMatcher($routeCollection, $context);

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

try{
    $currentRequest = $matcher->match($pathInfo);
    $page = $currentRequest['_route'];
    $controller = $currentRequest['controller'];
    call_user_func($controller, $currentRequest);
} 
catch(ResourceNotFoundException $e){
    require "templates/404.php";
}