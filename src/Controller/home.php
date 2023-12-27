<?php

/** @var Twig\Environment $twig */

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

session_start();

$folder = "images/";

$imgTab = array();

$imgTab = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);


if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
];

return new Response($twig->render('home/home.html.twig',['imgTab' =>$imgTab,'userdata' =>$userdata]));

