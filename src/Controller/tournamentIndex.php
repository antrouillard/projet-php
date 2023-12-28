<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\Response;

$TournamentRepository = $entityManager->getRepository(Tournament::class);
$Tournaments = $TournamentRepository->findAll();

return new Response($twig->render('tournament/tindex.html.twig', ['tournaments' => $Tournaments]));