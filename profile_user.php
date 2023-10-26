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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Страница пользователя - <?= $select_user['login'] ?></title>
</head>
<body>
    <a href="./index.php">На главную</a>
    <p>Редактировать профиль пользователя - <span><strong><?= $select_user['login'] ?></strong></span></p>
    <form method="post" id="edit_profile">
        <input type="hidden" name="id" value="<?= $select_user['id'] ?>">
        <input type="text" name="login" placeholder="Логин" value="<?= $select_user['login'] ?>" required>
        <input type="email" name="email" placeholder="E-mail" value="<?= $select_user['email'] ?>" required>
        <input type="submit" value="Сохранить">
    </form>
    <script>
        $(document).ready(function () {
            $("#edit_profile").submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "./vendor/vendor_edit_profile_user.php", // Путь к обработчику формы
                    data: formData,
                    success: function (response) {
                        if (response === "success") {
                            alert("Профиль пользователя успешно обновлен!");
                            location.reload();
                        } else {
                            alert("Что-то пошло не так. Пожалуйста, попробуйте еще раз.");
                            location.reload();
                        }
                    },
                    error: function (error) {
                        console.error(error);
                        alert("Произошла ошибка при отправке данных на сервер.");
                    }
                });
            });
        });
    </script>
</body>
</html>