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

$routes->add('tournamentIndex', new Route('/tournament'));
$routes->add('tournamentNew', new Route('/tournament/tnew'));
$routes->add('tournamentShow', new Route('/tournament/{id}', [], ['id' => ('\d+')]));
$routes->add('tournamentEdit', new Route('/tournament/{id}/tedit', [], ['id' => ('\d+')]));
$routes->add('tournamentDelete', new Route('/tournament/{id}/tdelete', [], ['id' => ('\d+')]));
$routes->add('login', new Route('/login'));
$routes->add('logout', new Route('/logout'));
$routes->add('register', new Route('/register'));

$routes->add('teamNew', new Route('/team/tenew'));
$routes->add('teamShow', new Route('/team/{id}', [], ['id' => ('\d+')]));

$routes->add('gameMatchNew', new Route('/gameMatch/mnew'));
$routes->add('gameMatchShow', new Route('/gameMatch/{id}', [], ['id' => ('\d+')]));

return $routes;
