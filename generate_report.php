<?php 
session_start();
$id = $_COOKIE['id_user'];
if(empty($id)) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ./login.php");
}
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
                                    <span>Сформировать отчет о работе</span>
                                </div>
                            </div>
                            <hr>
                            <div class="mnw-body">
                                <h1>Формирование отчета</h1>
                                <form action="./vendor/vendor_generate_report.php" method="post" class="generate_report_form">
                                    <div>
                                        <label for="start_date">Начальное число</label>
                                        <input type="date" name="start_date" id="start_date">
                                    </div>
                                    <br>
                                    <div>
                                        <label for="due_date">Конечное число</label>
                                        <input type="date" name="due_date" id="due_date">
                                    </div>
                                    <input type="submit" value="Создать" class="ctf-button">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <h2>Даная страница не доступна для администратора</h2>
    <?php } ?>
        <script src="https://kit.fontawesome.com/61b86703fe.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>