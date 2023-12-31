<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Team;
use Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$TeamRepository = $entityManager->getRepository(Team::class);
$Teams = $TeamRepository->findAll();

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
    'id' => $_SESSION['id'],
];
$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(['name'=>$userdata['username']]);
if ($user) {
    $gravatarUrl = $user->getGravatarUrl();
}

return new Response($twig->render('team/teindex.html.twig', [
    'teams' => $Teams,
    'userdata' =>$userdata,
    'gravatarUrl'=>$gravatarUrl
]));