<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Team;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

session_start();

if(!isset($_SESSION['loggedin'])){
    return new RedirectResponse('/login');
}

$teamRepository = $entityManager->getRepository(Team::class);
$team = $teamRepository->find($id);

if ($team == null) {
    new RedirectResponse('/');
}
else {
    $folder = "images/";
    $imgPath = $folder . $team->getImgPath();
    $img = null;

    if (file_exists($imgPath)) {
        $img = "/".$imgPath;
    }
}

$userdata = [
    'username' => $_SESSION['name'],
    'loggedin' => $_SESSION['loggedin'],
    'id' => $_SESSION['id'],
];

return new Response($twig->render('team/teshow.html.twig', [
    'team' => $team,
    'img' => $img,
    'userdata' =>$userdata
]));
