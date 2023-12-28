<?php

/** @var Twig\Environment $twig */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

return new Response($twig->render('search/search.html.twig', [
    'tournaments' => $Tournaments,
]));

