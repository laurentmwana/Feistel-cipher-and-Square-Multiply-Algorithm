<?php

// on charge l'autoload
// pour charger automatique les classes, functions
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// on récupère l'url
$url = explode('?', $_SERVER['REQUEST_URI'])[0] ?? '/';

// on charge l'en-tête
require __DIR__ . DIRECTORY_SEPARATOR . 'header.php';

if ($url === '/') {
    require __DIR__ . DIRECTORY_SEPARATOR . 'links' . DIRECTORY_SEPARATOR . 'home.php';
} else {
    require __DIR__ . DIRECTORY_SEPARATOR . 'links' . DIRECTORY_SEPARATOR . 'error.php';
}
require __DIR__ . DIRECTORY_SEPARATOR . 'footer.php';