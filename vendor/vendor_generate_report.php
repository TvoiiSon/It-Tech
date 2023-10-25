<?php
session_start();
if(empty($_COOKIE['id_user'])) {
    $_SESSION['errLogin'] = "Авторизуйтесь!";
    header("Location: ../login.php");
}
require_once("../db/db.php");

$id = $_COOKIE['id_user'];
$start_date = $_POST["start_date"];
$due_date = $_POST["due_date"];

$select_complite_tasks = mysqli_query($connect, "SELECT * FROM `tasks` WHERE `status`='Выполнено' AND `start_date`>='$start_date' AND `due_date`<='$due_date' AND `id_owner`='$id'");
$select_complite_tasks = mysqli_fetch_all($select_complite_tasks);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Сформированный отчет</title>
</head>
<body>
    <a href="../index.php">На главную</a>
    <h3>Отчет за период <?= $start_date ?> / <?= $due_date ?></h3>
    <table border="1">
    <tr>
        <th>ID</th>
        <th>Название задачи</th>
        <th>Описание задачи</th>
        <th>Дата начала работы</th>
        <th>Дата завершения работы</th>
        <th>Категория задачи</th>
        <th>Статус</th>
    </tr>
    <?php
    if (!empty($select_complite_tasks)) {
        foreach ($select_complite_tasks as $task) {
            $id_task_categ = $task[6];
            $select_category = mysqli_query($connect, "SELECT * FROM `category` WHERE `id`='$id_task_categ'");
            $select_category = mysqli_fetch_assoc($select_category);
            echo '<tr>';
            echo '<td>' . $task[0] . '</td>';
            echo '<td>' . $task[2] . '</td>';
            echo '<td>' . $task[3] . '</td>';
            echo '<td>' . $task[4] . '</td>';
            echo '<td>' . $task[5] . '</td>';
            echo '<td>' . $select_category['category_name'] . '</td>';
            echo '<td>' . $task[9] . '</td>';
            echo '</tr>';
        }
        echo '<tr>';
        echo '<td>Итого выполнено задач</td>';
        echo '<td colspan="5">' . count($select_complite_tasks) . '</td>';
        echo '</tr>';
    } else {
        echo '<tr><td colspan="7">Нет завершенных задач в указанный период.</td></tr>';
    }
    ?>
    </table>
    <canvas id="myChart" width="400" height="100"></canvas>
    <script>
        var dataFromPHP = <?php echo json_encode($select_complite_tasks); ?>;
        var canvas = document.getElementById('myChart');
        var ctx = canvas.getContext('2d');
        var months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        var completedTasksData = new Array(12).fill(0);
        var labels = [];
        for (var i = 0; i < months.length; i++) {
            labels.push(months[i]);
        }
        var completedTasksData = [];
        for (var i = 0; i < months.length; i++) {
            var monthTasks = dataFromPHP.filter(function (task) {
                var taskDate = new Date(task[5]);
                return taskDate.getMonth() === i;
            });
            completedTasksData.push(monthTasks.length);
        }
        var data = {
            labels: labels,
            datasets: [{
                label: 'Количество выполненных задач',
                data: completedTasksData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>