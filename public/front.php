<?php

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Exception\ResourceNotFoundException;
// use Symfony\Component\Routing\Matcher\UrlMatcher;
// use Symfony\Component\Routing\RequestContext;
// use Symfony\Component\Routing\Route;
// use Symfony\Component\Routing\RouteCollection;

// $request = Request::createFromGlobals();

// $context = new RequestContext();

// $context->fromRequest($request);


// require_once '../vendor/autoload.php';


// $routes = new RouteCollection();
// // $routes->add('hello',  new Route('/hello/{name}', ['name' => 'world']));

// $routes->add('hello', new Route('/hello/{name}', [
//     'name' => 'World',
//     '_controller' => 'render_template',
// ]));




// function render_template($request):Response
// {
//     extract($request->attributes->all(), EXTR_SKIP);
//     ob_start();
//     include sprintf('./pages/%s.php', $_route);

//     return new Response(ob_get_clean());
// }

// $matcher = new UrlMatcher($routes, $context);

// try {
//     $request->attributes->add($matcher->match($request->getPathInfo()));
//     $response = call_user_func($request->attributes->get('_controller'), $request);

// } catch (ResourceNotFoundException $exception) {
//     $response = new Response('Страница не существует', 404);
// } catch (Exception $exception) {
//     $response = new Response('Ошибка сервера', 500);
// }

// $response->send();