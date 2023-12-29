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

$participant1Id = $participant1->getId();
$participant2Id = $participant2->getId();

$user1 = $userRepository->findOneBy(['id' => $participant1Id]);
if (is_null($participant1)) {
    $team1 = $teamRepository->findOneBy(['id'=> $participant1Id]);
    $nameParticipant1 = $team1->getName();
}
else {
    $nameParticipant1 = $user1->getName();
}

$user2 = $userRepository->findOneBy(['id' => $participant2Id]);
if (is_null($participant2)) {
    $team2 = $teamRepository->findOneBy(['id'=> $participant2Id]);
    $nameParticipant2 = $team2->getName();
}
else{
    $nameParticipant2 = $user2->getName();
}

return new Response($twig->render('gameMatch/mshow.html.twig', [
    'GameMatch' => $GameMatch,
    'nameParticipant1' => $nameParticipant1,
    'nameParticipant2'=> $nameParticipant2,
]));