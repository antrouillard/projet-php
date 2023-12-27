<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

$userRepository = $entityManager->getRepository(User::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    $user = (new User())
        ->setUsername($request->get('username'))
        ->setPassword(password_hash($request->get('password'), PASSWORD_DEFAULT));

    $violations = $validator->validate($user);

    if ($violations->count() == 0) {
        $entityManager->persist($user);
        $entityManager->flush();

        return new RedirectResponse('/login');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('register/register.html.twig', ['violations' => $arrayViolations]));