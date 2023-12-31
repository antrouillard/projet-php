<?php
use Entity\Tournament;
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

$tournamentRepository = $entityManager->getRepository(Tournament::class);

$arrayViolations = [];

$directory = __DIR__.'/../../public/images';


if (Request::METHOD_POST == $request->getMethod()) {
    $tournament = new Tournament();
    $tournament->setName($request->get('name'));
    $tournament->setEntryPrice((int) $request->get('entryPrice'));
    $tournament->setRules($request->get('rules'));
    $tournament->setNbSlots($request->get('nbSlots'));
    $tournament->setNbSlotsTaken(0);
    $tournament->setMail($request->get('mail'));
    $tournament->setAdress($request->get('adress'));
    $tournament->setPrizeMoney($request->get('prizeMoney'));

    try {
        $startDate = new \DateTime($request->get('startDate'));
    } catch (\Exception $e) {
        $arrayViolations['startDate'][] = "La date fournie est invalide.";
        return new Response($twig->render('tournament/tnew.html.twig', ['violations' => $arrayViolations]));
    }

    $tournament->setStartDate($startDate);

    try {
        $endDate = new \DateTime($request->get('endDate'));
    } catch (\Exception $e) {
        $arrayViolations['endDate'][] = "La date fournie est invalide.";
        return new Response($twig->render('tournament/tnew.html.twig', ['violations' => $arrayViolations]));
    }

    $tournament->setEndDate($endDate);
    
    $uploadedFile = $request->files->get('tournamentImage');

    if ($uploadedFile instanceof UploadedFile) {
        $newFileName = md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

        $uploadedFile->move($directory, $newFileName);

        $tournament->setImgPath($newFileName);
    }

    $violations = $validator->validate($tournament);

    if ($violations->count() == 0) {
        $entityManager->persist($tournament);
        $entityManager->flush();

        return new RedirectResponse('/');
    } else {
        foreach ($violations as $violation) {
            $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
        }
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

return new Response($twig->render('tournament/tnew.html.twig', [
    'violations' => $arrayViolations,
    'userdata' =>$userdata,
    'gravatarUrl'=>$gravatarUrl
]));
