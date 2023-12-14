<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var int $id
 * @var ValidatorInterface $validator
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->find($id);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $User
        ->setName($request->get('name'))
        ->setFirstname($request->get('firstname'))
        ->setOld($request->get('old'));

    $violations = $validator->validate($User);

    if ($violations->count() == 0) {
        $entityManager->persist($User);
        $entityManager->flush();

        return new RedirectResponse('/user');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('user/edit.html.twig', ['user' => $User, 'violations' => $arrayViolations]));