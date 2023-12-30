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

session_start();

$userRepository = $entityManager->getRepository(User::class);

$arrayViolations = [];

if ($request->isMethod('POST')) {

    $username = $request->get('username');
    $password = $request->get('password');
    $mail = $request->get('mail');

    $user = $userRepository->findOneBy(['name' => $username]);

    if ($user && password_verify($password, $user->getPassword())) {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $user->getId();
        }
        return new RedirectResponse('/');
    } else {
        $arrayViolations['authentication'][] = 'Nom d\'utilisateur ou mot de passe incorrect.';
    }
}

return new Response($twig->render('login/login.html.twig', ['violations' => $arrayViolations]));