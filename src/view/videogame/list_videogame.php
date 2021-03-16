<?php require '../src/view/partial/header.php'; ?>
<h1>CRUD</h1>

<?php
echo $message;
if (!empty($errors)) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li style='color: red'>$error</li>";
    }
    echo "</ul>";
}
?>
<table>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>prix</th>
    </tr>
    <?php foreach ($games as $game) : ?>
        <tr>
            <td><?= $game->getId() ?></td>
            <td><?= $game->getName() ?></td>
            <td><?= $game->getPrice() ?></td>
            <td><a href="update-jeu?id=<?= $game->getId() ?>">modifier</a></td>
            <td><a href="delete-jeu?id=<?= $game->getId() ?>"
                   onclick="return confirm('Voulez vous supprimer cet utisateur ?');">supprimer</a></td>

        </tr>
    <?php endforeach; ?>
</table>
<div><a href="insert-jeu">Ajouter un jeu</a></div>




<?php require '../src/view/partial/footer.php'; ?>

