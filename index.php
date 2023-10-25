<?php 
session_start();
$id = $_COOKIE['id_user'];
if(empty($id)) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$select_users = mysqli_query($connect, "SELECT * FROM `users` WHERE `role` = '2'");
$select_users = mysqli_fetch_all($select_users);

$select_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_owner` = '$id'");
$select_tasks = mysqli_fetch_all($select_tasks);

$select_working_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_participant`='$id' AND `status`!='Выполнено'");
$select_working_tasks = mysqli_fetch_all($select_working_tasks);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>
<body>
    <a href="./logout.php">Выйти</a>
    <?php if($_COOKIE['role'] == 1){ ?>
        <h2>Создать пользователя</h2>
        <form action="./vendor/vendor_create_user.php" method="post">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="confirm_password" placeholder="Подтверждение Пароля" required>
            <input type="submit" value="Создать">
        </form>
        <br>

        <h2>Список пользователей</h2>
        <ul>
            <?php foreach($select_users as $user) { ?>
                <li>
                    <span>Логин: <?= $user[3] ?></span><br>
                    <span>E-mail: <?= $user[5] ?></span><br>
                    <a href="./profile_user.php?id=<?= $user[0] ?>">Перейти в профиль</a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    <?php if($_COOKIE['role'] == 2){ ?>
        <h2>Создать задачу/проект</h2>
        <form action="./vendor/vendor_create_task.php" method="post" style="display: flex; flex-direction: column; width: 350px; gap: 15px;">
            <input type="text" name="task_name" placeholder="Название задачи/проекта" required>
            <textarea name="task_description"cols="30" rows="10" placeholder="Описание задачи/проекта" required></textarea>
            <label for="due_date">Срок выполнения</label>
            <input type="date" name="due_date" required>
            <div>
                <p>Приоритет задачи/проекта</p>
                <div>
                    <label for="priority1">1</label>
                    <input type="radio" id="priority1" name="priority" value="1" required><br>
                    <label for="priority2">2</label>
                    <input type="radio" id="priority2" name="priority" value="2" required><br>
                    <label for="priority3">3</label>
                    <input type="radio" id="priority3" name="priority" value="3" required><br>
                    <label for="priority4">4</label>
                    <input type="radio" id="priority4" name="priority" value="4" required><br>
                    <label for="priority5">5</label>
                    <input type="radio" id="priority5" name="priority" value="5" required><br>
                    <label for="priority6">6</label>
                    <input type="radio" id="priority6" name="priority" value="6" required><br>
                    <label for="priority7">7</label>
                    <input type="radio" id="priority7" name="priority" value="7" required><br>
                    <label for="priority8">8</label>
                    <input type="radio" id="priority8" name="priority" value="8" required><br>
                    <label for="priority9">9</label>
                    <input type="radio" id="priority9" name="priority" value="9" required><br>
                    <label for="priority10">10</label>
                    <input type="radio" id="priority10" name="priority" value="10" required><br>
                </div>
            </div>
            <input type="submit" value="Создать">
        </form>

        <h2>Список задач/проектов</h2>
        <ul>
            <?php foreach($select_tasks as $task) { ?>
                <li>
                    <span><?= $task[2] ?></span><br>
                    <a href="./task.php?id=<?= $task[0] ?>">Перейти к задаче/проекту</a>
                </li>
                <br>
            <?php } ?>
        </ul>

        <h2>Задачи/проекты для выполнения</h2>
        <ul>
            <?php foreach($select_working_tasks as $task) { ?> 
                <li>
                    <a href="./working_task.php?id=<?= $task[0] ?>"><?= $task[2] ?></a>
                </li>
            <?php } ?>
        </ul>
        
    <?php } ?>
</body>
</html>