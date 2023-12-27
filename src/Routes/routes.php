<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/'));
$routes->add('hello', new Route('/hello/{name}', ['name' => 'World']));
$routes->add('userIndex', new Route('/user'));
$routes->add('userNew', new Route('/user/new'));
$routes->add('userShow', new Route('/user/{id}', [], ['id' => ('\d+')]));
$routes->add('userEdit', new Route('/user/{id}/edit', [], ['id' => ('\d+')]));
$routes->add('userDelete', new Route('/user/{id}/delete', [], ['id' => ('\d+')]));
$routes->add('search', new Route('/search'));
$routes->add('create', new Route('/create'));
$routes->add('tournament', new Route('/tournament/{id}',[],['id' => ('\d+')]));
$routes->add('login', new Route('/login'));
$routes->add('logout', new Route('/logout'));
$routes->add('register', new Route('/register'));

return $routes;
