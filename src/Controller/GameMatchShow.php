<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\GameMatch;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$GameMatch = $GameMatchRepository->find($id);

$participant1 = $GameMatch->getParticipant1();
$participant2 = $GameMatch->getParticipant2();

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
];

return new Response($twig->render('gameMatch/mshow.html.twig', [
    'GameMatch' => $GameMatch,
    'participant1' => $participant1,
    'participant2'=> $participant2,
    'userdata' =>$userdata
]));