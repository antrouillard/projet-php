<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$tournamentRepository = $entityManager->getRepository(Tournament::class);
$tournament = $tournamentRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $student
        ->setName($request->get('name'))
        ->setEntryPrice($request->get('entryPrice'))
        ->setRules($request->get('rules'));

    $violations = $validator->validate($tournament);

    if ($violations->count() == 0) {
        $entityManager->persist($tournament);
        $entityManager->flush();

        return new RedirectResponse('/tournament');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('tournament/tedit.html.twig', ['tournament' => $tournament, 'violations' => $arrayViolations]));