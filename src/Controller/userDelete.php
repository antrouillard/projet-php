<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

$UserRepository = $entityManager->getRepository(User::class);
$User = $UserRepository->find($id);

$entityManager->remove($User);
$entityManager->flush();

return new RedirectResponse('/user');