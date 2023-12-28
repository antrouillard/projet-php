<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Entity\Inscription;
use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$tournamentRepository = $entityManager->getRepository(Tournament::class);
$userRepository = $entityManager->getRepository(User::class);
$inscriptionRepository = $entityManager->getRepository(Inscription::class);

$tournament = $tournamentRepository->find($id);


$folder = "images/";
$imgPath = $folder . $tournament->getImgPath();
$img = null;

if (file_exists($imgPath)) {
    $img = "/".$imgPath;
}


$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
];

$user = $userRepository->findOneBy(['username' => $userdata['username']]);

$UserAlreadyRegistered = false;

$checkUserRegistration = $inscriptionRepository->findOneBy([
    'user' => $user,
    'tournament' => $tournament,
]);

if ($checkUserRegistration) {
    $UserAlreadyRegistered = true;
}

$arrayViolations = null;
if (Request::METHOD_POST == $request->getMethod()) {
    
    $currentDateTime = new DateTime('now');
    echo $tournament;
    $inscription = (new Inscription())
        ->setDateInscription($currentDateTime)
        ->setEmail($request->get('email'))
        ->setTournament($tournament)
        ->setUser($user);
    
    $violations = $validator->validate($inscription);

    if ($violations->count() == 0) {
        $tournamentSlotsTaken = $tournament->getNbSlotsTaken();
        $tournament->setNbSlotsTaken($tournamentSlotsTaken+1);

        $entityManager->persist($inscription);
        $entityManager->flush();
        return new RedirectResponse('/tournament'.'/'.$id);
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}


return new Response($twig->render('tournament/tshow.html.twig', [
    'tournament' => $tournament,
    'img' => $img,
    'userdata' => $userdata,
    'violations' => $arrayViolations,
    'UserAlreadyRegistered' => $UserAlreadyRegistered,
]));