<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\Team;
use Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}


$directory = __DIR__.'/../../public/images';

$TeamRepository = $entityManager->getRepository(Team::class);

$arrayViolations = [];

if (Request::METHOD_POST == $request->getMethod()) {
    
    $team = (new Team())
        
        ->setName($request->get('name'))
        ->setNiveau($request->get('niveau'))
        ->setPlayersNames($request->get('playersNames'));

        $uploadedFile = $request->files->get('teamImage');

    if ($uploadedFile instanceof UploadedFile) {
        $newFileName = md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

        $uploadedFile->move($directory, $newFileName);

        $team->setImgPath($newFileName);
    }

    $violations = $validator->validate($team);

    if ($violations->count() == 0) {
        $teamId = $team->getId();
        $entityManager->persist($team);
        $entityManager->flush(); 
        return new RedirectResponse('/team');
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
$userRepository = $entityManager->getRepository(User::class);
$user = $userRepository->findOneBy(['name'=>$userdata['username']]);
if ($user) {
    $gravatarUrl = $user->getGravatarUrl();
}

return new Response($twig->render('team/tenew.html.twig', [
    'violations' => $arrayViolations,
    'userdata' =>$userdata,
    'gravatarUrl'=>$gravatarUrl
]));