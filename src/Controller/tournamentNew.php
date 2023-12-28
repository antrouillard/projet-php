<?php
use Entity\Tournament;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

$tournamentRepository = $entityManager->getRepository(Tournament::class);

$arrayViolations = [];

$directory = __DIR__.'/../../public/images';


if (Request::METHOD_POST == $request->getMethod()) {
    // Créez une nouvelle instance de l'entité Tournament
    $tournament = new Tournament();
    $tournament->setName($request->get('name'));
    $tournament->setEntryPrice((int) $request->get('entryPrice'));
    $tournament->setRules($request->get('rules'));
    $tournament->setNbSlots($request->get('nbSlots'));
    $tournament->setNbSlotsTaken(0);
    $tournament->setMail($request->get('mail'));
    $tournament->setAdress($request->get('adress'));
    $tournament->setPrizeMoney($request->get('prizeMoney'));

    // Convertissez la date reçue en objet DateTime
    try {
        $startDate = new \DateTime($request->get('startDate'));
    } catch (\Exception $e) {
        // Gérez l'erreur si la date n'est pas valide
        $arrayViolations['startDate'][] = "La date fournie est invalide.";
        return new Response($twig->render('tournament/tnew.html.twig', ['violations' => $arrayViolations]));
    }

    $tournament->setStartDate($startDate);

    try {
        $endDate = new \DateTime($request->get('endDate'));
    } catch (\Exception $e) {
        // Gérez l'erreur si la date n'est pas valide
        $arrayViolations['endDate'][] = "La date fournie est invalide.";
        return new Response($twig->render('tournament/tnew.html.twig', ['violations' => $arrayViolations]));
    }

    $tournament->setEndDate($endDate);
    
    $uploadedFile = $request->files->get('tournamentImage');

    if ($uploadedFile instanceof UploadedFile) {
        // Générez un nom de fichier unique
        $newFileName = md5(uniqid()) . '.' . $uploadedFile->getClientOriginalExtension();

        // Déplacez le fichier téléchargé vers le répertoire approprié (à ajuster selon vos besoins)
        $uploadedFile->move($directory, $newFileName);

        // Mettez à jour le champ imgPath de l'entité Tournament
        $tournament->setImgPath($newFileName);
    }


    // Validez l'entité Tournament
    $violations = $validator->validate($tournament);

    if ($violations->count() == 0) {
        // Si pas de violations, enregistrez l'entité
        $entityManager->persist($tournament);
        $entityManager->flush();

        // Redirigez après l'enregistrement
        return new RedirectResponse('/tournament');
    } else {
        // Ajoutez les violations au tableau pour l'affichage
        foreach ($violations as $violation) {
            $arrayViolations[$violation->getPropertyPath()][] = $violation->getMessage();
        }
    }
}

// Renvoyez la réponse avec le formulaire et les violations
return new Response($twig->render('tournament/tnew.html.twig', ['violations' => $arrayViolations]));
