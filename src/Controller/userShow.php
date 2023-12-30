<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\User;
use Symfony\Component\HttpFoundation\Response;

session_start();

$UserRepository = $entityManager->getRepository(User::class);

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
    'id' => $_SESSION['id'],
];

$User = $UserRepository->findOneBy(['name' => $userdata['username']]);


return new Response($twig->render('user/show.html.twig', [
    'user' => $User,
    'userdata' =>$userdata
]));