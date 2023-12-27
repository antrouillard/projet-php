<?php

/** @var Twig\Environment $twig */

use Symfony\Component\HttpFoundation\Response;

$folder = "images/";

$imgTab = array();

$imgTab = glob($folder . '*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);

return new Response($twig->render('home/home.html.twig',['imgTab' =>$imgTab]));

