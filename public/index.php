<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require_once '../vendor/autoload.php';

$request = Request::createFromGlobals();

$routes = new RouteCollection();

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$controller = $controllerResolver->getController($request);
$arguments = $argumentResolver->getArguments($request, $controller);

$response = call_user_func_array($controller, $arguments);
// $routes->add('hello', new Route('/hello/{name}', [
//     'name' => 'World',
//     '_controller' => function ($request) {
//         extract($request->attributes->all(), EXTR_SKIP);
//         ob_start();
//         include sprintf('./pages/%s.php', $_route);
    
//         return new Response(ob_get_clean());
//     }
// ]));

$routes->add('leap_year', new Route('/is_leap_year/{year}', [
    'year' => null,
    '_controller' => [new LeapYearController(), 'index'],
]));


$routes->add('bye',  new Route('/bye'));

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_controller'), $request);

} catch (ResourceNotFoundException $exception) {
    $response = new Response('Страница не существует', 404);
} catch (Exception $exception) {
    $response = new Response('Ошибка сервера', 500);
}

$response->send();