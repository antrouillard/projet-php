<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\Response;

$tournamentRepository = $entityManager->getRepository(Tournament::class);
$tournament = $tournamentRepository->find($id);

return new Response($twig->render('tournament/tshow.html.twig', ['tournament' => $tournament]));