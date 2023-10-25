<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$id_user = $_GET['id'];
$select_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$id_user'");
$select_user = mysqli_fetch_assoc($select_user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница пользователя - <?= $select_user['login'] ?></title>
</head>
<body>
    <p>Редактировать профиль пользователя - <span><strong><?= $select_user['login'] ?></strong></span></p>
    <form action="./vendor/vendor_edit_profile_user.php" method="post">
        <input type="hidden" name="id" value="<?= $select_user['id'] ?>">
        <input type="text" name="login" placeholder="Логин" value="<?= $select_user['login'] ?>" required>
        <input type="email" name="email" placeholder="E-mail" value="<?= $select_user['email'] ?>" required>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>