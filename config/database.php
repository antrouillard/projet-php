<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: array(dirname(__DIR__) . "/src/Entity"),
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => dirname(__DIR__) . '/db.sqlite',
], $config);

return new EntityManager($connection, $config);

/*
// Crée les tables à partir des entités
$entityManager->getConnection()->getSchemaManager()->createDatabase();
$tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
$metadata = $entityManager->getMetadataFactory()->getAllMetadata();
$tool->createSchema($metadata);

return $entityManager;

/*use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [dirname(__DIR__) . "/src/Entity"],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => dirname(__DIR__) . '/db.sqlite',
], $config);

$entityManager = new EntityManager($connection, $config);

// Vérifie si la base de données existe
$databasePath = dirname(__DIR__) . '/db.sqlite';
if (!file_exists($databasePath)) {
    // Crée la base de données si elle n'existe pas
    touch($databasePath);
    
    // Crée les tables à partir des entités
    $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
    $tool->createSchema($metadata);
}

return $entityManager;


use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [dirname(__DIR__) . "/src/Entity"],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'path' => dirname(__DIR__) . '/db.sqlite',
], $config);

$entityManager = new EntityManager($connection, $config);

// Vérifie si la base de données existe
$databasePath = dirname(__DIR__) . '/db.sqlite';
if (!file_exists($databasePath)) {
    try {
        // Crée la base de données si elle n'existe pas
        touch($databasePath);

        // Crée les tables à partir des entités
        $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
        $metadata = $entityManager->getMetadataFactory()->getAllMetadata();
        $tool->createSchema($metadata);
    } catch (\Exception $e) {
        echo 'Erreur lors de la création des tables : ' . $e->getMessage();
        // Gérer l'erreur en conséquence
    }
}

// Pas de "return" nécessaire dans ce script



*/