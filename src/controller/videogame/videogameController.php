<?php

namespace App\controller\videogame;

use App\database\Connection;
use App\model\videogame\Videogame;
use App\model\videogame\VideogameManager;


class videogameController
{


    public function list()
    {
        $message = "";
        $pdo = Connection::getPdo();
        $videogameManager = new VideogameManager($pdo);
        $games = $videogameManager->getAll();
        require '../src/view/videogame/list_videogame.php';
        return $content;
    }

    public function insert(){
        $name = "";
        $price = "";
        $message = "";
        $buttonTitle = "Ajouter";
        $pdo = Connection::getPdo();
        $videogameManager = new VideogameManager($pdo);

            if (isset($_POST['insert_game'])) {
                $game = $videogameManager->handleRequest();
                $errors = $videogameManager->validate($game);

                if (empty($errors)) {
                    $insert = $videogameManager->insert($game);
                    header('Location: /');
                    exit();
                } else {
                    $messsage = "erreurs";
                }
            }


        require '../src/view/videogame/form_videogame.php';
        return $content;
    }

    public function update()
    {
        $name = "";
        $price = "";
        $message = "";
        $buttonTitle = "Modifier";
        $pdo = Connection::getPdo();
        $videogameManager = new VideogameManager($pdo);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $game = $videogameManager->getOne($id);
            $name = $game->getName();
            $price = $game->getPrice();

            if (isset($_POST['insert_game'])) {
                $updateGame = $videogameManager->handleRequest($id);
                $errors = $videogameManager->validate($updateGame);

                if (empty($errors)) {
                    $update = $videogameManager->update($updateGame);
                    header('Location: /');
                    exit();
                } else {
                    $messsage = "erreurs";
                }
            }


        } else {
            $messsage = "pas d'id";
        }
        require '../src/view/videogame/form_videogame.php';
        return $content;
    }

    public function delete()
    {
        $pdo = Connection::getPdo();
        $videogameManager = new VideogameManager($pdo);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $game = $videogameManager->getOne($id);
            $videogameManager->delete($game);
            header('Location: /');
            exit();
        } else {
            $messsage = "pas d'id";
        }

    }


}
