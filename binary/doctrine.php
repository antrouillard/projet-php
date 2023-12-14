#!/usr/bin/env php
<?php

/**
 * @var Doctrine\ORM\EntityManager $entityManager
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

require_once dirname(__DIR__) .
'/vendor/autoload.php';
$entityManager = require_once dirname(__DIR__) .
'/config/database.php';

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);

