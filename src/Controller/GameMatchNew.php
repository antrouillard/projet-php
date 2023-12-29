<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\GameMatch;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$GameMatchRepository = $entityManager->getRepository(GameMatch::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $gameMatch = (new GameMatch())
        ->setParticipant1($request->get('participant1'))
        ->setParticipant2($request->get('participant2'))
        ->setJeu($request->get('jeu'));

        try {
            $matchDate = new \DateTime($request->get('matchDate'));
        } catch (\Exception $e) {
            // Gérez l'erreur si la date n'est pas valide
            $arrayViolations['matchDate'][] = "La date fournie est invalide.";
            return new Response($twig->render('gameMatch/mnew.html.twig', ['violations' => $arrayViolations]));
        }
    
        $matchDate->setMatchDate($matchDate);

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
$users = $entityManager->getRepository(User::class)->findAll();
$teams = $entityManager->getRepository(Team::class)->findAll();

return new Response($twig->render('gameMatch/mnew.html.twig', [
    'violations' => $arrayViolations,
    'users' => $users,
    'teams' => $teams,
]));