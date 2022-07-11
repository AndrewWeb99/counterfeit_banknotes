<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}

require_once 'vendor/settings.php';

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
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.theme.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фактов обнаружения</title>
</head>

<body>
    <style>
        .gallery {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }



        .gallery img {
            border: 2px solid black;
            margin-right: 10px;
            width: 15%;
        }
    </style>
    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <div class="facts_four_section">
            <h2>Журнал действий пользователей</h2>
            <table id="userTable" class="cell-border hover row-border" style="width:100%">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>ФИО пользователя</th>
                        <th>Действие</th>
                        <th>Номер факта</th>
                        <th>Секция</th>
                        <th>ID записи</th>
                        <th>Дата</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $jou = $mysqli->query("SELECT * FROM `journal`");
                    $jou = mysqli_fetch_all($jou);
                    $number = 0;
                    foreach ($jou as $num) {
                        $number++;
                        echo '
                        <tr>
                            
                            <td>' . $number . '</td>
                            <td>' . $num[1] . '</td>
                            <td>' . $num[2] . '</td>
                            <td>' . $num[3] . '</td>
                            <td>' . $num[4] . '</td>
                            <td>' . $num[5] . '</td>
                            <td>' . $num[6] . '</td>
                        </tr>                            
                            ';
                    };
                    ?>
                </tbody>
            </table>

        </div>




    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
</body>

</html>