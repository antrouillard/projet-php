<?php

/** @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Entity\User;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$folder = "images/";

$imgTab = array();
 
$TournamentRepository = $entityManager->getRepository(Tournament::class);
$Tournaments = $TournamentRepository->findAll();

foreach ($Tournaments as $tournament) {
    // Construire le chemin complet pour chaque image
    $imgPath = $folder . $tournament->getImgPath();
    
    // Vérifier si le fichier existe avant de l'ajouter à $imgTab
    if (file_exists($imgPath)) {
        $imgTab[] = $imgPath;
    }
}

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
];

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(['username'=>$userdata['username']]);
$gravatarUrl = $user->getGravatarUrl();

return new Response($twig->render('home/home.html.twig',['imgTab' =>$imgTab,'userdata' =>$userdata,'tournaments'=>$Tournaments,'gravatarUrl'=>$gravatarUrl]));

