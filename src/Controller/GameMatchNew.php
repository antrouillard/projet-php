<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\GameMatch;
use Entity\User;
use Entity\Team;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();
$teamRepository = $entityManager->getRepository(Team::class);
$teams = $teamRepository->findAll();


$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $username1 = $request->get('participant1');
    $username2 = $request->get('participant2');
    $user1 = $userRepository->findOneBy(['username' => $username1]);
    $user2 = $userRepository->findOneBy(['username' => $username2]);
    echo' 1 : '. $user1 .' 2 : '. $user2 .'';
    $gameMatch = (new GameMatch())
        ->setParticipant1($user1)
        ->setParticipant2($user2)
        ->setJeu($request->get('jeu'));

        try {
            $matchDate = new \DateTime($request->get('matchDate'));
        } catch (\Exception $e) {
            // Gérez l'erreur si la date n'est pas valide
            $arrayViolations['matchDate'][] = "La date fournie est invalide.";
            return new Response($twig->render('gameMatch/mnew.html.twig', ['violations' => $arrayViolations]));
        }
    
        $gameMatch->setMatchDate($matchDate);

    $violations = $validator->validate($gameMatch);

    if ($violations->count() == 0) {
        $entityManager->persist($gameMatch);
        $entityManager->flush();

        return new RedirectResponse('/gameMatch');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('gameMatch/mnew.html.twig', [
    'violations' => $arrayViolations,
    'users' => $users,
    'teams' => $teams,
]));