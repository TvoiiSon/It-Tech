<?php 
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}

require_once("./db/db.php");

$id = $_COOKIE['id_user'];
$select_working_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE FIND_IN_SET('$id', REPLACE(`id_participant`, ' ', '')) AND `status`!='Выполнено' ORDER BY `priority` DESC");
$select_working_tasks = mysqli_fetch_all($select_working_tasks);

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="./styles/style.css">
    </head>
    <body>
    <?php if($_COOKIE['role'] == 2) { ?>
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
                                        <a href="./create_task.php">
                                            <span><i class="fa-solid fa-calendar-plus"></i></span>
                                            <span>Создать задачу/проект</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./all_tasks.php">
                                            <span><i class="fa-solid fa-briefcase"></i></span>
                                            <span>Задачи/проекты в работе</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./generate_report.php">
                                            <span><i class="fa-solid fa-briefcase"></i></span>
                                            <span>Сформировать отчет о работе</span>
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
                                    <span>Задачи/Проекты в работе</span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <h1>Список задач/проектов</h1>
                                <table class="table-fill">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Название Задачи</th>
                                            <th class="text-left">Перейти к задаче/проекту</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-hover">
                                        <?php foreach($select_working_tasks as $task) { ?>
                                            <tr>
                                                <td class="text-left"><?= $task[2] ?></td>
                                                <td class="text-left"><a href="./working_task.php?id=<?= $task[0] ?>">Перейти</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <h2>Даная страница не доступна для администратора</h2>
    <?php } ?>
        <script src="./scripts/main.js"></script>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>