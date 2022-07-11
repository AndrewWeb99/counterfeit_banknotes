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
    <title>ЕРДР/УД</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="/vendor/erdr.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Добавление ЕРДР/УД</h1>

            <div class="facts_sections">
                <div class="facts_one_frame">

                    <div class="facts_one_section">
                        <h2>ЕРДР/УД</h2>
                        <div class="field">
                            <label for="n">Номер ЕРДР</label>
                            <input type="text" name="num_er" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Номер УД</label>
                            <input type="text" name="num_ud_er" required/>
                        </div>
                        <div class="field">
                            <label for="a">Квалификация УК РК</label>
                            <input type="text" name="kval_er" required/>
                        </div>
                        <div class="field">
                            <label for="a">Орган УД</label>
                            <input type="text" name="org_er" required/>
                        </div>
                        <div class="field">
                            <label for="a">Статус УД</label>
                            <input type="text" name="status_er" required/>
                        </div>
                    </div>

                    <div class="facts_two_section">
                        <h2 style="visibility: hidden;">Продолжение</h2>
                        <div class="field">
                            <label for="n">Дата регистрации в ЕРДР</label>
                            <input type="date" name="date_reg_er" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Дата ВУД</label>
                            <input type="date" name="date_v_er" required/>
                        </div>
                        <div class="field">
                            <label for="a">Переквалификация</label>
                            <input type="text" name="perkval_er" required/>
                        </div>
                        <div class="field">
                            <label for="ln">В отношении</label>
                            <select name="role_er" required>
                                <option value="Подозреваемый" selected>Подозреваемый</option>
                                <option value="Свидетель">Свидетель</option>
                                <option value="Понятой">Понятой</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="n">Сотрудник</label>
                            <input type="text" name="sot_er" value="<?= $_SESSION["user"]["name"] ?>" required/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="facts_four_section">
                <h2>Участники уголовного дела</h2>
                <a class="button_table" href="/v_block_erdr/uch.php" style="padding: 1px;">Добавить</a>
                <table id="userTable" class="cell-border hover row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>ФИО</th>
                            <th>Роль</th>
                            <th>Тип документа</th>
                            <th>Адрес</th>
                            <th>Удалить</th>
                            <th>Изменить</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $max_id = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
                    $nummain = mysqli_fetch_all($max_id);
                    foreach ($nummain as $nus) {
                        $max_id = $nus[0];
                    };
                    $numb = 0;
                    $cep = $mysqli->query("SELECT * FROM `members` WHERE num_fact_me = '$max_id'");
                    $cep = mysqli_fetch_all($cep);

                    foreach ($cep as $num) {
                        $numb++;
                        echo '
                        <tr>
                            <td>' . $numb . '</td>
                            <td>' . $num[3] . ' ' . $num[4] . ' ' . $num[5] . '</td>
                            <td>' . $num[11] . '</td>
                            <td>' . $num[8] . '</td>
                            <td>' . $num[7] . '</td>
                            <td><a class="button_table" href="#">Изменить</a></td>
                            <td><a class="button_table" href="#">Удалить</a></td>
                        </tr>
                            
                            
                            ';
                    };
                    ?>
                    </tbody>
                </table>
            </div>


            <div class="facts_four_section">
                <h2>Принятое по делу решение</h2>
                <a class="button_table" href="/v_block_erdr/resh.php" style="padding: 1px;">Добавить</a>
                <table id="userTable1" class="cell-border hover row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Резолюция</th>
                            <th>Статья УПК РК</th>
                            <th>Дата принятия</th>
                            <th>Решение суда</th>
                            <th>Удалить</th>
                            <th>Изменить</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $max_id = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
                    $nummain = mysqli_fetch_all($max_id);
                    foreach ($nummain as $nus) {
                        $max_id = $nus[0];
                    };
                    $cep = $mysqli->query("SELECT * FROM `resh` WHERE num_fact_re = '$max_id'");
                    $cep = mysqli_fetch_all($cep);
                    $number = 0;
                    foreach ($cep as $num) {
                        $number++;
                        echo '
                        <tr>
                            
                            <td>' . $number . '</td>
                            <td>' . $num[2] . '</td>
                            <td>' . $num[5] . '</td>
                            <td>' . $num[4] . '</td>
                            <td>' . $num[9] . '</td>
                            <td><a class="button_table" href="#">Изменить</a></td>
                            <td><a class="button_table" href="#">Удалить</a></td>
                        </tr>
                            
                            
                            ';
                    };
                    ?>
                    </tbody>
                </table>

            </div>

            <div class="facts_four_section">
                <h2>Присоединенные УД</h2>
                
                <table id="userTable2" class="cell-border hover row-border" style="width:100%">
                    <thead>
                        <tr>
                            <th>Номер УД</th>
                            <th>Дата ВУД</th>
                            <th>Квалификация УК РК</th>
                            <th>Орган ВУД</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $max_id = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
                    $nummain = mysqli_fetch_all($max_id);
                    foreach ($nummain as $nus) {
                        $max_id = $nus[0];
                    };
                    $cep = $mysqli->query("SELECT * FROM `additional_cases`");
                    $cep = mysqli_fetch_all($cep);
                    $number = 0;
                    foreach ($cep as $num) {
                        echo '
                        <tr>
                            
                            <td>' . $num[1] . '</td>
                            <td>' . $num[2] . '</td>
                            <td>' . $num[3] . '</td>
                            <td>' . $num[4] . '</td>
                            <td>' . $num[5] . '</td>

                        </tr>
                            
                            
                            ';
                    };
                    ?>
                    </tbody>
                </table>

            </div>


            <input type="submit" value="Отправить">
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>

   
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
</body>

</html>