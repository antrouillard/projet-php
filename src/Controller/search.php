<?php

/** @var Twig\Environment $twig */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$folder = "images/";
$imgTab = glob($folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Récupérez les paramètres de recherche depuis la requête
/*$searchTerm = $_GET['search'] ?? null;
$date = $_GET['date'] ?? null;
$location = $_GET['location'] ?? null;*/

// Faites la logique de recherche en fonction des paramètres
// Exemple de résultats de recherche (remplacez cela par votre propre logique)
$searchResults = [
    ['name' => 'Tournoi A', 'date' => '2023-12-15', 'location' => 'Lieu A'],
    ['name' => 'Tournoi B', 'date' => '2023-12-20', 'location' => 'Lieu B'],
];

return new Response($twig->render('search/search.html.twig', [
    'imgTab' => $imgTab,
    'searchResults' => $searchResults,
]));
