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

$select_category = mysqli_query($connect,"SELECT * FROM `category`");
$select_category = mysqli_fetch_all($select_category);

$select_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `id_owner` = '$id' ORDER BY `id` DESC");
$select_tasks = mysqli_fetch_all($select_tasks);

$select_working_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE FIND_IN_SET('$id', REPLACE(`id_participant`, ' ', '')) AND `status`!='Выполнено' ORDER BY `priority` DESC");
$select_working_tasks = mysqli_fetch_all($select_working_tasks);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/style.css">
    <title>Главная</title>
</head>
<body>
    <a href="./logout.php">Выйти</a>
    <?php if($_COOKIE['role'] == 1){ ?>
        <h2>Создать пользователя</h2>
        <form id="create_user" class="create_user_form" method="post">
            <input type="text" name="login" placeholder="Логин" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="confirm_password" placeholder="Подтверждение Пароля" required>
            <input type="submit" value="Создать">
        </form>
        <br>

        <h2>Список пользователей</h2>
        <table border="1">
            <tr height="40px">
                <th width="100px">Логин</th>
                <th width="200px">Email</th>
                <th width="200px">Ссылка на профили</th>
            </tr height="40px">
            <?php foreach($select_users as $user) { ?>
                <tr>
                    <td><?= $user[2] ?></td>
                    <td><?= $user[4] ?></td>
                    <td><a href="./profile_user.php?id=<?= $user[0] ?>">Перейти в профиль</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    <?php if($_COOKIE['role'] == 2){ ?>
        <br>
        <a href="./generate_report.php">Сформировать отчет</a>
        <h2>Создать задачу/проект</h2>
        <form method="post" id="create_task" class="create_task_form">
            <input type="text" name="task_name" placeholder="Название задачи/проекта" required>
            <textarea name="task_description"cols="30" rows="10" placeholder="Описание задачи/проекта" required></textarea>
            <div>
                <input type="radio" id="form1" name="work_type" value="once">
                <label for="form1">Разовая работа</label>
                <br>
                <input type="radio" id="form2" name="work_type" value="continuous">
                <label for="form2">Продолжительная работа</label>
            </div>
            <div id="once_calendar" style="display: none">
                <label for="single_date_start">Дата начала</label>
                <input type="date" name="single_date_start" id="single_date_start">
            </div>
            <div id="continuous_calendar" style="display: none">
                <label for="start_date">Срок начала выполнения</label>
                <input type="date" name="start_date" id="start_date">
                <br>
                <label for="due_date">Срок конца выполнения</label>
                <input type="date" name="due_date" id="due_date">
            </div>
            <select name="category">
                <?php foreach($select_category as $category) { ?>
                    <option value="<?= $category[0] ?>"><?= $category[1] ?></option>
                <?php } ?>
            </select>
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
        <table border="1">
            <tr height="40px">
                <th width="250px">Название Задачи</th>
                <th width="250px">Перейти к задаче/проекту</th>
            </tr>
            <?php foreach($select_tasks as $task) { ?>
                <tr height="40px">
                    <td><?= $task[2] ?></td>
                    <td>
                        <a href="./task.php?id=<?= $task[0] ?>">Перейти к задаче/проекту</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h2>Задачи/проекты для выполнения</h2>
        <ul class="list_in_work">
            <?php foreach($select_working_tasks as $task) { ?> 
                <li>
                    <a href="./working_task.php?id=<?= $task[0] ?>"><?= $task[2] ?></a><br>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    
    <script>
        $.ajax({
            url: './vendor/vendor_get_task.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                data.forEach(function(task) {
                    var dueDate = new Date(task.due_date);
                    var currentDate = new Date();

                    var timeDifference = dueDate - currentDate;
                    if (timeDifference > 0) {
                        alert(task.task_name + ' должна быть сдана в течение 2 дней!');
                    }
                });
            }
        });
        $(document).ready(function () {
            $.ajax({
                url: './vendor/vendor_send_mail.php',
                type: 'GET',
                success: function (response) {
                    console.log(response);
                }
            });
        });
    </script>
    <script src="./scripts/main.js"></script>
</body>
</html>