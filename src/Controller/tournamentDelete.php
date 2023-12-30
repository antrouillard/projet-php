<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Entity\Inscription;
use Symfony\Component\HttpFoundation\RedirectResponse;

$TournamentRepository = $entityManager->getRepository(Tournament::class);
$inscriptionRepository = $entityManager->getRepository(Inscription::class);

$Tournament = $TournamentRepository->find($id);
$Inscriptions = $inscriptionRepository->findBy(['tournament' => $Tournament]);

foreach ($Inscriptions as $inscription) {
    $entityManager->remove($inscription);
    $entityManager->flush();
}

$entityManager->remove($Tournament);
$entityManager->flush();

return new RedirectResponse('/');