<?php

/**
 * @var Twig\Environment $twig
 * @var Doctrine\ORM\EntityManager $entityManager
 * @var Request $request
 * @var ValidatorInterface $validator
 */

use Entity\Team;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        // Générez un nom de fichier unique
        $newFileName = md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

        // Déplacez le fichier téléchargé vers le répertoire approprié (à ajuster selon vos besoins)
        $uploadedFile->move($directory, $newFileName);

        // Mettez à jour le champ imgPath de l'entité Team
        $team->setImgPath($newFileName);
    }

    $violations = $validator->validate($team);

    if ($violations->count() == 0) {
        $entityManager->persist($team);
        $entityManager->flush();

        return new RedirectResponse('/team/tenew');
    }
    foreach ($violations as $violation) {
        $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
    }
}

return new Response($twig->render('team/tenew.html.twig', ['violations' => $arrayViolations]));