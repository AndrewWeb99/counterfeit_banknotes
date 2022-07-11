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
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фальшивых денег</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="reestr_banknote.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Реестр фальшивых денег</h1>
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">
                        <h2>Место обнаружения фальшивой купюры</h2>
                        <div class="field">
                            <label for="n">Серия</label>
                            <input type="text" name="ser_b" />
                        </div>
                        <div class="field">
                            <label for="ln">Номер</label>
                            <input type="text" name="num_b" />
                        </div>
                        <div class="field">
                            <label for="n">Год выпуска</label>
                            <input type="text" name="year_b" />
                        </div>
                        <div class="field">
                            <label for="ln">Валюта</label>
                            <input type="text" name="val_b" />
                        </div>
                        <div class="field">
                            <label for="a">Номинал</label>
                            <input type="text" name="nom_b" />
                        </div>
                    </div>


                </div>
                <br>
                <input type="submit" value="Найти"> <a class="buttons" href="">Очистить</a>
                <div class="facts_four_section">
                    <h2>Результаты</h2>

                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№ факта</th>
                                <th>Серия и номер</th>
                                <th>Номинал</th>
                                <th>Валюта</th>
                                <th>Год выпуска</th>
                                <th>Удалить</th>
                                <th>Изменить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $new_arr = array_diff($_POST, array(''));
                            $ser_b = $new_arr['ser_b'];
                            $num_b = $new_arr['num_b'];
                            $year_b = $new_arr['year_b'];
                            $val_b = $new_arr['val_b'];
                            $nom_b = $new_arr['nom_b'];


                            $sql = "SELECT * FROM banknote table1 JOIN facts table2 ON table1.numb_ba=table2.banknote WHERE table1.id_ba > 0";
                            if (isset($new_arr['ser_b'])) {
                                $sql = $sql . " AND table1.ser_one_ba LIKE '%$ser_b%' or table1.ser_two_ba LIKE '%$ser_b%'";
                            };
                            if (isset($new_arr['num_b'])) {
                                $sql = $sql . " AND table1.number_one_ba LIKE '%$num_b%' or table1.number_two_ba LIKE '%$num_b%'";
                            };
                            if (isset($new_arr['year_b'])) {
                                $sql = $sql . " AND table1.date_ba LIKE '%$year_b%'";
                            };
                            if (isset($new_arr['val_b'])) {
                                $sql = $sql . " AND table1.val_ba LIKE '%$val_b%'";
                            };
                            if (isset($new_arr['nom_b'])) {
                                $sql = $sql . " AND table1.nominal_ba LIKE '%$nom_b%'";
                            };
                            // echo $sql;
                            // $data = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
                            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
                            $cep  = $mysqli->query($sql);
                            if (mysqli_num_rows($cep) > 0) {
                                $cep = mysqli_fetch_all($cep);
                                foreach ($cep as $num) {
                                    if ($_SESSION["user"]["role"] == 'Оперативный сотрудник') {
                                        echo '
                                        <tr>
                                            <td>' . $num[16] . '</td>
                                            <td>' . $num[6] . '_' . $num[7] . '   ' . $num[8] . '-' . $num[9] . '</td>
                                            <td>' . $num[11] . '</td>
                                            <td>' . $num[3] . '</td>
                                            <td>' . $num[10] . '</td>                            
                                            <td><a class="button_table" href="/blocks/open_reestr_banknote.php?num=' . $num[0] . '">Открыть</a></td>
                                            <td>Нет доступа</td>
                                        </tr>                              
                                            ';
                                    } else {
                                        echo '
                                        <tr>
                                            <td>' . $num[16] . '</td>
                                            <td>' . $num[6] . '_' . $num[7] . '   ' . $num[8] . '-' . $num[9] . '</td>
                                            <td>' . $num[11] . '</td>
                                            <td>' . $num[3] . '</td>
                                            <td>' . $num[10] . '</td>                            
                                            <td><a class="button_table" href="/blocks/open_reestr_banknote.php?num=' . $num[0] . '">Открыть</a></td>
                                            <td><a class="button_table" href="/blocks/update_reestr_banknote.php?num=' . $num[0] . '">Изменить</a></td>
                                        </tr>                               
                                            ';
                                    }
                                };
                            } else {
                                echo 'Проверьте введенные данные!!!';
                            };


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