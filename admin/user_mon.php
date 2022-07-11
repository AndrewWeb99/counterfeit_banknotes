<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once '../vendor/settings.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/facts.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Управление пользователями</title>
</head>

<body>
    <!-- заголовок -->
    <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('../blocks/nav.php'); ?>

        <form action="reestr_facts.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Управление пользователями</h1>
            <div class="facts_sections">
                <div class="facts_four_section">
                    <h2></h2>
                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№ пользователя</th>
                                <th>Логин</th>
                                <th>ФИО</th>
                                <th>Уровень доступа</th>
                                <th>Статус</th>
                                <th>Изменить</th>
                                <th>Изменить статус</th>
                                <th>Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql =  "SELECT * FROM `users`";
                            $cep  = $mysqli->query($sql);
                            if (mysqli_num_rows($cep) > 0) {
                                $cep = mysqli_fetch_all($cep);
                                $number = 0;
                                foreach ($cep as $num) {
                                    $stat = '';
                                    if ($num[5] == 'Доступен') {
                                        $stat = 'Заблокировать';
                                    } else {
                                        $stat = 'Разблокировать';
                                    }
                                    $number++;
                                    echo '
                                        <tr>
                                            <td>' . $number . '</td>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[2] . '</td>
                                            <td>' . $num[3] . '</td>
                                            <td>' . $num[5] . '</td>
                                            <td><a class="button_table" href="/admin/vendor/update_users.php?num=' . $num[0] . '">Изменить</a></td>
                                            <td><a class="button_table" href="/admin/vendor/update_users_status.php?num=' . $num[0] . '">' . $stat . '</a></td>
                                            <td><a class="button_table" href="/admin/vendor/v_del_users.php?num=' . $num[0] . '">Удалить</a></td>
                                        </tr>                              
                                            ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>


        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
</body>

</html>