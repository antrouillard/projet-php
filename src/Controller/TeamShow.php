<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Team;
use Symfony\Component\HttpFoundation\Response;

$teamRepository = $entityManager->getRepository(Team::class);
$team = $teamRepository->find($id);

$folder = "images/";
$imgPath = $folder . $team->getImgPath();
$img = null;

// Vérifier si le fichier existe avant de l'ajouter à $imgTab
if (file_exists($imgPath)) {
    $img = "/".$imgPath;
}
else {
    echo 'ALED';
}

return new Response($twig->render('team/teshow.html.twig', ['team' => $team,'img' => $img]));