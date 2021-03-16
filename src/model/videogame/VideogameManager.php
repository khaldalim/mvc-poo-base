<?php


namespace App\model\videogame;

use PDO;

class VideogameManager
{


    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function getAll(): array
    {
        $query = "SELECT * from videogame";
        $statement = $this->pdo->query($query);

        $games = [];
        while ($game = $statement->fetch(PDO::FETCH_ASSOC)) {
            $games[] = new Videogame($game['id'], $game['name'], $game['price']);
        }
        return $games;
    }


    public function getOne($id): Videogame
    {
        $query = "SELECT * from videogame WHERE id = :id";
        $stm = $this->pdo->prepare($query);
        $stm->execute([
            ':id' => $id
        ]);
        $dataGame = $stm->fetch(PDO::FETCH_ASSOC);

        $game = null;
        if ($dataGame != null) {
            $game = new Videogame($dataGame['id'], $dataGame['name'], $dataGame['price']);
        }

        return $game;
    }

    public function insert(Videogame $game)
    {
        $sql = "INSERT INTO videogame (name, price)
VALUES (:name, :price)";
        $stm = $this->pdo->prepare($sql);
        $insertok = $stm->execute([
            ':name' => $game->getName(),
            ':price' => $game->getPrice()
        ]);

        return $insertok;
    }

    public function update(Videogame $game)
    {
        $sql = "UPDATE videogame set name = :name ,
                                price = :price                                
                            WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute([
            ':name' => $game->getName(),
            ':price' => $game->getPrice(),
            ':id' => $game->getId()
        ]);
    }

    public function delete(Videogame $game)
    {
        $sql = "DELETE FROM videogame WHERE id = :id;";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([':id' => $game->getId()]);
    }

    public function handleRequest($id = null)
    {
        $name = filter_input(INPUT_POST, 'name');
        $price = filter_input(INPUT_POST, 'price');

        return new Videogame($id, $name, $price);
    }

    public function validate(Videogame $game)
    {
        $errors = [];

        if ($game->getName() == "") {
            $errors['name'] = "pas de nom";
        }
        if ($game->getPrice() == "") {
            $errors['price'] = "veuillez entrer un prix";
        }
    }
}
