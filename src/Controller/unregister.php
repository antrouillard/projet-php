<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Entity\User;
use Entity\GameMatch;
use Entity\Inscription;
use Symfony\Component\HttpFoundation\RedirectResponse;

session_start();

$UserRepository = $entityManager->getRepository(User::class);
$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$inscriptionRepository = $entityManager->getRepository(Inscription::class);

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
    'id' => $_SESSION['id'],
];

$User = $UserRepository->findOneBy(['name' => $userdata['username']]);

$GameMatchs = $GameMatchRepository->findAll();

foreach ($GameMatchs as $gameMatch) {
    $participant1 = $gameMatch->getParticipant1();
    $participant2 = $gameMatch->getParticipant2();
    
    if ($participant1 == $User || $participant2 == $User) {
        $entityManager->remove($gameMatch);
        $entityManager->flush();
    } 
}

$Inscriptions = $inscriptionRepository->findBy(['user' => $User]);

foreach ($Inscriptions as $inscription) {
    $entityManager->remove($inscription);
    $entityManager->flush();
}



$entityManager->remove($User);
$entityManager->flush();

session_destroy();

return new RedirectResponse('/login');