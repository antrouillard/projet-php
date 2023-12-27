<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;

$studentRepository = $entityManager->getRepository(Tournament::class);
$student = $tournamentRepository->find($id);

$entityManager->remove($tournament);
$entityManager->flush();

return new RedirectResponse('/tournament');