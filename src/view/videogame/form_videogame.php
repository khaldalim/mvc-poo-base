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

<h2><?= $buttonTitle ?> un jeu</h2>
<form method="post" name="insert_user">
    <input type="text" name="name" value="<?= $name ?>">
    <input type="number" step=".01" name="price" value="<?= $price ?>">
    <input type="submit" value="<?= $buttonTitle ?>" name="insert_game">
</form>


<?php require '../src/view/partial/footer.php'; ?>

