<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\GameMatch;
use Symfony\Component\HttpFoundation\RedirectResponse;

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$GameMatch = $GameMatchRepository->find($id);

$entityManager->remove($GameMatch);
$entityManager->flush();

return new RedirectResponse('/');