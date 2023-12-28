<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;

$TournamentRepository = $entityManager->getRepository(Tournament::class);
$Tournament = $TournamentRepository->find($id);

$entityManager->remove($Tournament);
$entityManager->flush();

return new RedirectResponse('/tournament');