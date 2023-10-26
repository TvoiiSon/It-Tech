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
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CASTCASEDOTCOME | It-Tech</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
        <?php if($_COOKIE['role'] == 1) { ?>
        <div class="container-fluid">
            <div class="row wrapper">
                <div class="col-lg-3 wrapper-left">
                    <div class="sidebar">
                        <div class="sidebar-wrapper">
                            <div class="sw-logo">
                                <div class="swl-wrapper">
                                    <p>CASTCASEDOTCOME | It-Tech</p>
                                </div>
                            </div>
                            <div class="sw-link-list">
                                <ul>
                                    <li>
                                        <a href="./index.php">
                                            <span><i class="fa-solid fa-house"></i></span>
                                            <span>Главная</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./create_user.php">
                                            <span><i class="fa-solid fa-calendar-plus"></i></span>
                                            <span>Создать пользователя</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./logout.php">
                                            <span><i class="fa-solid fa-door-open"></i></span>
                                            <span>Выйти</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="main-content">
                        <div class="main-content-wrapper">
                            <div class="mnw-header">
                                <div class="mnw-header-wrapper">
                                    <span>Профиль пользователя - <?= $select_user['login'] ?></span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <h1>Форма обновления данных пользователя</h1>
                                <form method="post" id="edit_profile" class="edit_profile_form">
                                    <input type="hidden" name="id" value="<?= $select_user['id'] ?>">
                                    <div class="text-field text-field_floating-2">
                                        <input class="text-field__input" type="text" id="login" name="login" placeholder="Логин" value="<?= $select_user['login'] ?>" required>
                                        <label class="text-field__label" for="login">Логин</label>
                                    </div>
                                    <div class="text-field text-field_floating-2">
                                        <input class="text-field__input" type="email" id="email" name="email" placeholder="Email" value="<?= $select_user['email'] ?>" required>
                                        <label class="text-field__label" for="email">Email</label>
                                    </div>
                                    <input type="submit" value="Сохранить" class="ctf-button">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <h2>Доступно только администратору</h2>
        <?php } ?>
        <script src="./scripts/main.js"></script>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>