<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\GameMatch;
use Symfony\Component\HttpFoundation\Response;

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$GameMatch = $GameMatchRepository->find($id);

$participant1 = $GameMatch->getParticipant1();
$participant2 = $GameMatch->getParticipant2();

/*$participant1Id = $participant1->getId();
$participant2Id = $participant2->getId();*/




return new Response($twig->render('gameMatch/mshow.html.twig', [
    'GameMatch' => $GameMatch,
    'participant1' => $participant1,
    'participant2'=> $participant2,
]));