<?php

require_once '../vendor/autoload.php';

use App\controller\UserController;
use App\controller\videogame\videogameController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// on execute le controller en fonction de cette url

if ($url == "/") {
    $videogameController = new VideogameController();
    $content = $videogameController->list();
} elseif ($url == "/insert-jeu") {
    $videogameController = new VideogameController();
    $content = $videogameController->insert();
} elseif ($url == "/update-jeu") {
    $videogameController = new VideogameController();
    $content = $videogameController->update();
} elseif ($url == "/delete-jeu") {
    $videogameController = new VideogameController();
    $content = $videogameController->delete();
} else {
    //go to 404
    http_response_code(404);
    echo "Cette page n'existe pas";
}

echo $content;



