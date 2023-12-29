<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\Team;
use Symfony\Component\HttpFoundation\Response;

$TeamRepository = $entityManager->getRepository(User::class);
$Teams = $TeamRepository->findAll();

return new Response($twig->render('team/tindex.html.twig', ['teams' => $Teams]));