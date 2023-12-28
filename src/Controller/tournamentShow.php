<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var int $id
 */

use Entity\Tournament;
use Symfony\Component\HttpFoundation\Response;

$tournamentRepository = $entityManager->getRepository(Tournament::class);
$tournament = $tournamentRepository->find($id);

$folder = "images/";
$imgPath = $folder . $tournament->getImgPath();
$img = null;

// Vérifier si le fichier existe avant de l'ajouter à $imgTab
if (file_exists($imgPath)) {
    $img = "/".$imgPath;
}
else {
    echo "ALED";
}

return new Response($twig->render('tournament/tshow.html.twig', ['tournament' => $tournament,'img' => $img]));