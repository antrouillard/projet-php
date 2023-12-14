<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\User;
use Symfony\Component\HttpFoundation\Response;

$UserRepository = $entityManager->getRepository(User::class);
$User = $UserRepository->find($id);

return new Response($twig->render('user/show.html.twig', ['user' => $User]));