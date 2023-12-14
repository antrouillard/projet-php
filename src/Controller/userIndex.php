<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\User;
use Symfony\Component\HttpFoundation\Response;

$UserRepository = $entityManager->getRepository(User::class);
$Users = $UserRepository->findAll();

return new Response($twig->render('user/index.html.twig', ['users' => $Users]));