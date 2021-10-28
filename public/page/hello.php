<?php 
// $request = new Symfony\Component\HttpFoundation\Request();
// use Symfony\Component\HttpFoundation\Response;

$name = $request->get('name', 'World');

$response->setContent(sprintf('Hello %s',  htmlspecialchars($name, ENT_QUOTES, 'UTF-8')));