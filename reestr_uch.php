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

    <title>Реестр участников</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="reestr_uch.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Поиск по участникам</h1>
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">

                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" name="iin_uc" />
                        </div>
                        <div class="field">
                            <label for="ln">Фамилия</label>
                            <input type="text" name="fam_uc" />
                        </div>
                        <div class="field">
                            <label for="a">Имя</label>
                            <input type="text" name="name_uc" />
                        </div>
                        <div class="field">
                            <label for="a">Отчество</label>
                            <input type="text" name="otch_uc" />
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <select name="role_uc">
                                <option value="" selected>Не выбрано</option>
                                <option value="Работник органов">Работник органов</option>
                                <option value="Свидетель">Свидетель</option>
                                <option value="Работник банка">Работник банка</option>
                                <option value="Обвиняемый">Обвиняемый</option>
                                <option value="Понятой">Понятой</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Статус УД</label>
                            <input type="text" name="stat_uc" />
                        </div>
                    </div>

                </div>
                <br>
                <input type="submit" value="Найти">
                <a class="buttons" href="" style="width: 100%; 
  appearance:none;
  -webkit-appearance:none;
  /* usual styles */
  padding:13px;
  border:none;
  background-color:#3F51B5;
  color:#fff;
  font-weight:600;
  border-radius:5px;
  margin-left: 0px;
  text-decoration: none;">Очистить</a>
                <div class="facts_four_section">
                    <h2>Результаты</h2>
                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№ факта</th>
                                <th>ИИН</th>
                                <th>ФИО</th>
                                <th>Статус УД</th>
                                <th>Открыть</th>
                                <th>Изменить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $new_arr = array_diff($_POST, array(''));
                            $iin_uc = $new_arr['iin_uc'];
                            $fam_uc = $new_arr['fam_uc'];
                            $name_uc = $new_arr['name_uc'];
                            $otch_uc = $new_arr['otch_uc'];
                            $role_uc = $new_arr['role_uc'];
                            $stat_uc = $new_arr['stat_uc'];


                            $sql1 = "SELECT * FROM facts table1 JOIN edrd table2 ON table1.erdr = table2.id_er JOIN passed table3 ON table1.passed=table3.id_pa WHERE table1.id > 0";
                            $sql2 = "SELECT * FROM facts table1 JOIN edrd table2 ON table1.erdr = table2.id_er JOIN chain table3 ON table1.chain=table3.numb_ch WHERE table1.id > 0";
                            $sql3 = "SELECT * FROM facts table1 JOIN edrd table2 ON table1.erdr = table2.id_er JOIN members table3 ON table2.uud_num_er=table3.num_fact_me WHERE table1.id > 0";

                            if (isset($new_arr['iin_uc'])) {
                                $sql1 = $sql1 . " AND table3.iin_pa LIKE '%$iin_uc%'";
                                $sql2 = $sql2 . " AND table3.iin_ch LIKE '%$iin_uc%'";
                                $sql3 = $sql3 . " AND table3.iin_me LIKE '%$iin_uc%'";
                            };
                            if (isset($new_arr['fam_uc'])) {
                                $sql1 = $sql1 . " AND table3.fam_pa LIKE '%$fam_uc%'";
                                $sql2 = $sql2 . " AND table3.fam_ch LIKE '%$fam_uc%'";
                                $sql3 = $sql3 . " AND table3.fam_me LIKE '%$fam_uc%'";
                            };
                            if (isset($new_arr['name_uc'])) {
                                $sql1 = $sql1 . " AND table3.name_pa LIKE '%$name_uc%'";
                                $sql2 = $sql2 . " AND table3.name_ch LIKE '%$name_uc%'";
                                $sql3 = $sql3 . " AND table3.name_me LIKE '%$name_uc%'";
                            };
                            if (isset($new_arr['otch_uc'])) {
                                $sql1 = $sql1 . " AND table3.otch_pa LIKE '%$otch_uc%'";
                                $sql2 = $sql2 . " AND table3.otch_ch LIKE '%$otch_uc%'";
                                $sql3 = $sql3 . " AND table3.otch_me LIKE '%$otch_uc%'";
                            };
                            if (isset($new_arr['role_uc'])) {
                                $sql1 = $sql1 . " AND table3.role_pa LIKE '%$role_uc%'";
                                $sql2 = $sql2 . " AND table3.role_ch LIKE '%$role_uc%'";
                                $sql3 = $sql3 . " AND table3.role_me LIKE '%$role_uc%'";
                            };
                            if (isset($new_arr['stat_uc'])) {
                                $sql1 = $sql1 . " AND table2.status_er LIKE '%$stat_uc%'";
                                $sql2 = $sql2 . " AND table2.status_er LIKE '%$stat_uc%'";
                                $sql3 = $sql3 . " AND table2.status_er LIKE '%$stat_uc%'";
                            };

                            // echo $sql;
                            // $data = $mysqli->query($sql)->fetch_all(MYSQLI_ASSOC);
                            // echo json_encode($data, JSON_UNESCAPED_UNICODE);
                            $cep1  = $mysqli->query($sql1);
                            if (mysqli_num_rows($cep1) > 0) {
                                $cep1 = mysqli_fetch_all($cep1);
                                foreach ($cep1 as $num) { 
                                    if ($_SESSION["user"]["role"] == 'Оперативный сотрудник'){
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[23] . '</td>
                                            <td>' . $num[25] . ' ' . $num[24] . ' ' . $num[26] . '</td>
                                            <td>' . $num[13] . '</td>
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_passed.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td>Нет доступа</td>                                   
                                        </tr>                                
                                            ';
                                    }else{
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[23] . '</td>
                                            <td>' . $num[25] . ' ' . $num[24] . ' ' . $num[26] . '</td>
                                            <td>' . $num[13] . '</td>
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_passed.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td><a class="button_table" href="#">Изменить</a></td>                                   
                                        </tr>                                
                                            ';
                                    }
                                   
                                };
                            };

                            $cep2  = $mysqli->query($sql2);
                            if (mysqli_num_rows($cep2) > 0) {
                                $cep2 = mysqli_fetch_all($cep2);
                                foreach ($cep2 as $num) {
                                    if ($_SESSION["user"]["role"] == 'Оперативный сотрудник'){
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[25] . '</td>
                                            <td>' . $num[26] . ' ' . $num[27] . ' ' . $num[28] . '</td>
                                            <td>' . $num[13] . '</td> 
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_chain.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td>Нет доступа</td>                                     
                                        </tr>                                
                                            ';
                                    }else{
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[25] . '</td>
                                            <td>' . $num[26] . ' ' . $num[27] . ' ' . $num[28] . '</td>
                                            <td>' . $num[13] . '</td> 
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_chain.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td><a class="button_table" href="#">Изменить</a></td>                                     
                                        </tr>                                
                                            ';
                                    }
                                    
                                };
                            };

                            $cep3  = $mysqli->query($sql3);
                            if (mysqli_num_rows($cep3) > 0) {
                                $cep3 = mysqli_fetch_all($cep3);
                                foreach ($cep3 as $num) {
                                    if ($_SESSION["user"]["role"] == 'Оперативный сотрудник'){
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[24] . '</td>
                                            <td>' . $num[25] . ' ' . $num[26] . ' ' . $num[27] . '</td>
                                            <td>' . $num[13] . '</td>  
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_members.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td>Нет доступа</td>  
                                        </tr>                                
                                            ';
                                    }else {
                                        echo '
                                        <tr>
                                            <td>' . $num[1] . '</td>
                                            <td>' . $num[24] . '</td>
                                            <td>' . $num[25] . ' ' . $num[26] . ' ' . $num[27] . '</td>
                                            <td>' . $num[13] . '</td>  
                                            <td><a class="button_table" href="/v_block_uch_reestr/open_reestr_uch_members.php?num=' . $num[22] . '">Открыть</a></td>
                                            <td><a class="button_table" href="#">Изменить</a></td>  
                                        </tr>                                
                                            ';
                                    }
                                    
                                };
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