<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/'));

$routes->add('userShow', new Route('/user/{id}', [], ['id' => ('\d+')]));
$routes->add('userDelete', new Route('/user/{id}/delete', [], ['id' => ('\d+')]));

$routes->add('search', new Route('/search'));

$routes->add('tournamentNew', new Route('/tournament/tnew'));
$routes->add('tournamentShow', new Route('/tournament/{id}', [], ['id' => ('\d+')]));
$routes->add('tournamentEdit', new Route('/tournament/{id}/tedit', [], ['id' => ('\d+')]));
$routes->add('tournamentDelete', new Route('/tournament/{id}/tdelete', [], ['id' => ('\d+')]));

$routes->add('inscription_create', new Route('/inscription/create/{id}', ['_controller' => 'inscription_create_controller']));

$routes->add('login', new Route('/login'));
$routes->add('logout', new Route('/logout'));
$routes->add('register', new Route('/register'));
$routes->add('unregister', new Route('/unregister'));

$routes->add('teamIndex', new Route('/team'));
$routes->add('teamNew', new Route('/team/tenew'));
$routes->add('teamShow', new Route('/team/{id}', [], ['id' => ('\d+')]));
$routes->add('teamDelete', new Route('/team/{id}/delete', [], ['id' => ('\d+')]));

$routes->add('gameMatchNew', new Route('/gameMatch/mnew'));
$routes->add('gameMatchShow', new Route('/gameMatch/{id}', [], ['id' => ('\d+')]));
$routes->add('gameMatchDelete', new Route('/gameMatch/{id}/delete', [], ['id' => ('\d+')]));

return $routes;
