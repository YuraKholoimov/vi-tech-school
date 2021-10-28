<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require_once '../vendor/autoload.php';

$request = Request::createFromGlobals();
$response = new Response();
$context = new RequestContext();

$context->fromRequest($request);

$routes = new RouteCollection();
$routes->add('hello',  new Route('/hello/{name}', ['name' => 'wirld']));
$routes->add('bye',  new Route('/bye'));


$matcher = new UrlMatcher($routes, $context);
try {
    extract($matcher->match($request->getPathInfo(), EXTR_SKIP));
    ob_start();
    
    require sprintf('./page/%s.php', $_route);

} catch (ResourceNotFoundException $exception) {
    $response = new Response('Страница не существует', 404);
} catch (Exception $exception) {
    $response = new Response('Ошибка сервера', 500);
}


$response->send();