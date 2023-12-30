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

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);
$userRepository = $entityManager->getRepository(User::class);
$users = $userRepository->findAll();
$teamRepository = $entityManager->getRepository(Team::class);
$teams = $teamRepository->findAll();


$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $id1 = $request->get('participant1');
    $id2 = $request->get('participant2');

    $participant1 = $userRepository->findOneBy(['id' => $id1]);
    if (is_null($participant1)) {
        $participant1 = $teamRepository->findOneBy(['id'=> $id1]);
    }

    $participant2 = $userRepository->findOneBy(['id' => $id2]);
    if (is_null($participant2)) {
        $participant2 = $teamRepository->findOneBy(['id'=> $id2]);
    }
    

    $gameMatch = (new GameMatch())
        ->setParticipant1($participant1)
        ->setParticipant2($participant2)
        ->setJeu($request->get('jeu'));

        try {
            $matchDate = new \DateTime($request->get('matchDate'));
        } catch (\Exception $e) {
            $arrayViolations['matchDate'][] = "La date fournie est invalide.";
            return new Response($twig->render('gameMatch/mnew.html.twig', ['violations' => $arrayViolations]));
        }
    $gameMatch->setMatchDate($matchDate);

    $violations = $validator->validate($gameMatch);

    if ($violations->count() == 0) {
        $entityManager->persist($gameMatch);
        $entityManager->flush();

        return new RedirectResponse('/');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
    'id' => $_SESSION['id'],
];

return new Response($twig->render('gameMatch/mnew.html.twig', [
    'violations' => $arrayViolations,
    'users' => $users,
    'teams' => $teams,
    'userdata' =>$userdata
]));