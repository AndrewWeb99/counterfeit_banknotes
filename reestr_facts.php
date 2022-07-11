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
    <title>Реестр фактов обнаружения</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="reestr_facts.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Реестр фактов обнаружения</h1>
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">
                        <h2>Место обнаружения фальшивой купюры</h2>
                        <div class="field">
                            <label for="n">Номер факта</label>
                            <input type="text" name="num_f" />
                        </div>
                        <div class="field">
                            <label for="ln">Населенный пункт</label>
                            <input type="text" name="nasp_f" />
                        </div>
                        <div class="field">
                            <label for="a">Место изьятия</label>
                            <input type="text" name="mest_f" />
                        </div>
                    </div>

                    <div class="facts_two_section">
                        <h2>Сведения о банкноте</h2>
                        <div class="field">
                            <label for="n">Валюта</label>
                            <input type="text" name="val_f" />
                        </div>
                        <div class="field">
                            <label for="ln">Серия</label>
                            <input type="text" name="ser_f" />
                        </div>
                        <div class="field">
                            <label for="a">Номер</label>
                            <input type="text" name="numb_f" />
                        </div>
                    </div>
                </div>
                <br>
                <input type="submit" value="Найти">
                <a class="buttons" href="">Очистить</a>
                <div class="facts_four_section">
                    <h2>Результаты</h2>

                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№ факта</th>
                                <th>Населенный пункт</th>
                                <th>Место изъятия</th>
                                <th>Номер УД</th>
                                <th>Обстоятельства</th>
                                <th>Дата обнаружения</th>
                                <th>Открыть</th>
                                <th>Изменить</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $new_arr = array_diff($_POST, array(''));
                            $number = $new_arr['num_f'];
                            $nasp_f = $new_arr['nasp_f'];
                            $mest_f = $new_arr['mest_f'];
                            $val_f = $new_arr['val_f'];
                            $ser_f = $new_arr['ser_f'];
                            $numb_f = $new_arr['numb_f'];

                            $sql = "SELECT * FROM facts table1 JOIN place table2 ON table1.place=table2.id JOIN banknote table3 ON table1.banknote = table3.numb_ba JOIN edrd table4 ON table1.erdr = table4.id_er JOIN regist table5 ON table1.regsit = table5.id_re WHERE table1.id > 0";
                            if (isset($new_arr['num_f'])) {
                                $sql = $sql . " AND table1.number LIKE '%$number%'";
                            };
                            if (isset($new_arr['nasp_f'])) {
                                $sql = $sql . " AND table2.rn_p LIKE '%$nasp_f%'";
                            };
                            if (isset($new_arr['mest_f'])) {
                                $sql = $sql . " AND table2.place_p LIKE '%$mest_f%'";
                            };
                            if (isset($new_arr['val_f'])) {
                                $sql = $sql . " AND table3.val_ba LIKE '%$val_f%'";
                            };
                            if (isset($new_arr['ser_f'])) {
                                $sql = $sql . " AND table3.ser_one_ba LIKE '%$ser_f%' or table3.ser_two_ba LIKE '%$ser_f%'";
                            };
                            if (isset($new_arr['numb_f'])) {
                                $sql = $sql . " AND table3.number_one_ba LIKE '%$numb_f%' or table3.number_two_ba LIKE '%$numb_f%'";
                            };

                            // echo $sql;
                            // $data = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
                            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
                            $cep  = $mysqli->query($sql);
                            if (mysqli_num_rows($cep) > 0) {
                                $cep = mysqli_fetch_all($cep);
                                foreach ($cep as $num) {
                                    if ($_SESSION["user"]["role"] == 'Оперативный сотрудник'){
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[11] . '</td>
                                            <td>' . $num[9] . '</td>
                                            <td>' . $num[34] . '</td>
                                            <td>' . $num[50] . '</td>                            
                                            <td>' . $num[49] . '</td>
                                            <td><a class="button_table" href="/blocks/open_reestr_facts.php?num=' . $num[1] . '">Открыть</a></td>
                                            <td>Нет доступа</td>
                                        </tr>
                                                                           
                                            ';
                                    }else{
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[11] . '</td>
                                            <td>' . $num[9] . '</td>
                                            <td>' . $num[34] . '</td>
                                            <td>' . $num[50] . '</td>                            
                                            <td>' . $num[49] . '</td>
                                            <td><a class="button_table" href="/blocks/open_reestr_facts.php?num=' . $num[1] . '">Открыть</a></td>
                                            <td><a class="button_table" href="/blocks/update_reestr_facts.php?num=' . $num[1] . '">Изменить</a></td>
                                            
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