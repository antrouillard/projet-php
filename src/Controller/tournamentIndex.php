<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\Response;

$tournamentRepository = $entityManager->getRepository(Tournament::class);
$tournaments = $tournamentRepository->findAll();

return new Response($twig->render('tournament/tindex.html.twig', ['tournaments' => $tournaments]));