<?php

require 'vendor/autoload.php';

use Sabre\DAV;

// Chemin vers le répertoire où les fichiers seront stockés
$rootDirectory = new DAV\FS\Directory(__DIR__ . '/public');

// Configurer le serveur DAV
$server = new DAV\Server($rootDirectory);

// Configurer l'URL de base du serveur WebDAV
$baseUri = '/';
$server->setBaseUri($baseUri);

// Activer la fonction de verrouillage des fichiers (optionnel)
$lockBackend = new DAV\Locks\Backend\File(__DIR__ . '/locksdb');
$lockPlugin = new DAV\Locks\Plugin($lockBackend);
$server->addPlugin($lockPlugin);

// Activer le plugin Browser pour une meilleure interface
$browserPlugin = new DAV\Browser\Plugin();
$server->addPlugin($browserPlugin);

// Lancer le serveur
$server->exec();
