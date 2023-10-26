<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Авторизация</title>
</head>
<body>
    <h2>Авторизация</h2>
    <form action="./vendor/vendor_login.php" method="post" class="auth_form">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <input type="submit" value="Войти">
    </form>
</body>
</html>