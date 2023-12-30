<?php

/** @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Tournament;
use Entity\GameMatch;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$folder = "images/";

$imgTab = array();
$array_p1 = array();
$array_p2 = array();
 
$TournamentRepository = $entityManager->getRepository(Tournament::class);
$GameMatchRepository = $entityManager->getRepository(GameMatch::class);

$Tournaments = $TournamentRepository->findAll();
$GameMatchs = $GameMatchRepository->findAll();


foreach ($Tournaments as $tournament) {
    $imgPath = $folder . $tournament->getImgPath();
    
    if (file_exists($imgPath)) {
        $imgTab[] = $imgPath;
    }
}

foreach ($GameMatchs as $gameMatch) {
    $participant1 = $gameMatch->getParticipant1();
    $participant2 = $gameMatch->getParticipant2();

    $array_p1[] = $participant1;
    $array_p2[] = $participant2;
}

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
];

return new Response($twig->render('home/home.html.twig',[
    'imgTab' =>$imgTab,
    'userdata' =>$userdata,
    'tournaments'=>$Tournaments,
    'GameMatchs' => $GameMatchs,
    'array_p1' => $array_p1,
    'array_p2'=> $array_p2
])); 

