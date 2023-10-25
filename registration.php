<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
    <h2>Регистрация</h2>
    <form action="./vendor/vendor_registration.php" method="post">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="password" name="confirm_password" placeholder="Подтверждение Пароля" required>
        <input type="submit" value="Зарегистрироваться">
    </form>
    <a href="./login.php">Авторизация</a>
</body>
</html>