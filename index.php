<?php

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/controller/HomeController.php";

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

$routeCollection = new RouteCollection();
$routeCollection->add('home', $home);

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