<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$tournamentRepository = $entityManager->getRepository(Tournament::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $tournament = (new Tournament())
        ->setTournamentName($request->get('tournamentName'))
        ->setTournamentEmail($request->get('tournamentEmail'))
        ->setTournamentStartDate($request->get('tournamentStartDate'))
        ->setTournamentEndDate($request->get('tournamentEndDate'))
        ->setNbSlots($request->get('nb_slots'))
        ->setEntryPrice($request->get('entry_price'))
        ->setRules($request->get('rules'))
        ->setAdress($request->get('adress'))
        ->setPrize_money($request->get('prize_money'));

    $violations = $validator->validate($tournament);

    if ($violations->count() == 0) {
        $entityManager->persist($tournament);
        $entityManager->flush();

        return new RedirectResponse('/home');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('create/create.html.twig', ['violations' => $arrayViolations]));