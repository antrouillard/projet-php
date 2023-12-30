<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Team;
use Entity\GameMatch;
use Symfony\Component\HttpFoundation\RedirectResponse;

$TeamRepository = $entityManager->getRepository(Team::class);
$GameMatchRepository = $entityManager->getRepository(GameMatch::class);

$Team = $TeamRepository->find($id);

$GameMatchs = $GameMatchRepository->findAll();

$erreurs = [];

foreach ($GameMatchs as $gameMatch) {
    $participant1 = $gameMatch->getParticipant1();
    $participant2 = $gameMatch->getParticipant2();
    
    if ($participant1 == $Team) {
        $p2name = $participant2->getName();
        $erreurs[] = "Cette équipe est encore en lice dans le match contre " . $p2name . ". Si vous souhaitez supprimer cette équipe, supprimez d'abord ce match.";
    } else if ($participant2 == $Team) {
        $p1name = $participant1->getName();
        $erreurs[] = "Cette équipe est encore en lice dans le match contre " . $p1name . ". Si vous souhaitez supprimer cette équipe, supprimez d'abord ce match.";
    }
}

if (!empty($erreurs)) {
    foreach ($erreurs as $erreur) {
        echo $erreur . "<br>";
    }
} else {
    $entityManager->remove($Team);
    $entityManager->flush();

    return new RedirectResponse('/');
}