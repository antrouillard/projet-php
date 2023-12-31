<?php

/** @var Twig\Environment $twig */

use Entity\Tournament;
use Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$folder = "images/";

$TournamentRepository = $entityManager->getRepository(Tournament::class);
$Tournaments = $TournamentRepository->findAll();

$request = Request::createFromGlobals();

if ($request->isMethod('POST')) {
    $tname = $request->get('search');
    $tdate = $request->get('date');
    $tadress = $request->get('location');

    $qb = $TournamentRepository->createQueryBuilder('t');

    if ($tname != '') {
        $qb->andWhere('t.name LIKE :name')
           ->setParameter('name', '%' . $tname . '%');
    }

    if ($tdate != '') {
        $qb->andWhere('t.startDate = :startDate')
           ->setParameter('startDate', $tdate);
    }

    if ($tadress != '') {
        $qb->andWhere('t.adress LIKE :adress')
           ->setParameter('adress', '%' . $tadress . '%');
    }

    $Tournaments = $qb->getQuery()->getResult();
}

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

return new Response($twig->render('search/search.html.twig', [
    'tournaments' => $Tournaments,
    'userdata' =>$userdata,
    'gravatarUrl'=>$gravatarUrl
]));

