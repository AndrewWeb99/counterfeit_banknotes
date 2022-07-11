<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}

require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `banknote` WHERE id_ba = $num";
    // echo $sql1;
    //Выборка с банкнот
    $bank  = $mysqli->query($sql1);
    $bank = mysqli_fetch_assoc($bank);
    //Выборка с места обнаружения
    $sql1 = "SELECT * FROM `facts` WHERE banknote = " . $bank['numb_ba'];
    // echo $sql1;
    //Выборка с главной
    $fact  = $mysqli->query($sql1);
    $fact = mysqli_fetch_assoc($fact);
}
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
    <title>Изменение данных о подделке</title>
</head>

<body>
    <!-- заголовок -->
    <?php require('header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>
        <form action="/vendor/banknote.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Данные подделки</h1>
            <p>Номер факта: <?= $fact['banknote'] ?></p>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Общие данные</h2>
                    <div class="field">
                        <label for="ln">Тип</label>
                        <input id="dop_type" type="text" name="" value="<?= $bank['type_ba'] ?>" hidden />
                        <select name="type_ba" id="type_ba" disabled>
                            <option id="type_ba1" value="Банкнота">Банкнота</option>
                            <option id="type_ba2" value="Монета">Монета</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Валюта</label>
                        <input id="dop_val" type="text" name="" value="<?= $bank['val_ba'] ?>" hidden />
                        <select name="val_ba" id="val_ba" disabled>
                            <option id="val_ba1" value="Тенге" selected>Тенге</option>
                            <option id="val_ba2" value="Рубль">Рубль</option>
                            <option id="val_ba3" value="Евро">Евро</option>
                            <option id="val_ba4" value="Доллар">Доллар</option>
                            <option id="val_ba5" value="Другое">Другое</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Сувенир</label>
                        <input id="dop_suven" type="text" name="" value="<?= $bank['suven_ba'] ?>" hidden />
                        <select name="suven_ba" id="suven_ba" disabled>
                            <option id="suven_ba1" value="Да">Да</option>
                            <option id="suven_ba2" value="Нет" selected>Нет</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Комбинация</label>
                        <input id="dop_combo" type="text" name="" value="<?= $bank['combo_ba'] ?>" hidden />
                        <select name="combo_ba" id="combo_ba" disabled>
                            <option id="combo_ba1" value="Обычная" selected>Обычная</option>
                            <option id="combo_ba2" value="Половинчатая">Половинчатая</option>
                            <option id="combo_ba3" value="Подлинная">Подлинная</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="n">Серия</label>
                        <input type="text" name="ser_one_ba" id="ser_one_ba" maxlength="2" value="<?= $bank['ser_one_ba'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="n">Серия 2</label>
                        <input type="text" name="ser_two_ba" id="ser_two_ba" maxlength="2" value="<?= $bank['ser_two_ba'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Номер</label>
                        <input type="text" name="number_one_ba" id="number_one_ba" maxlength="2" value="<?= $bank['number_one_ba'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Номер 2</label>
                        <input type="text" name="number_two_ba" id="number_two_ba" maxlength="2" value="<?= $bank['number_two_ba'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Год выпуска</label>
                        <input type="date" name="date_ba" id="date_ba" value="<?= $bank['date_ba'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Номинал</label>
                        <input id="dop_nominal" type="text" name="" value="<?= $bank['nominal_ba'] ?>" hidden />
                        <select name="nominal_ba" id="nominal_ba" disabled>
                            <option id="nominal_opt" value="200" selected>200</option>
                            <option id="nominal_opt" value="500">500</option>
                            <option id="nominal_opt" value="1000">1000</option>
                            <option id="nominal_opt" value="2000">2000</option>
                            <option id="nominal_opt" value="5000">5000</option>
                            <option id="nominal_opt" value="10000">10000</option>
                            <option id="nominal_opt" value="20000">20000</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="a">Количество</label>
                        <input type="text" name="kol_ba" value="<?= $bank['kol_ba'] ?>" readonly/>
                    </div>

                    <!-- <div class="field">
                        <label for="ln">Экспертиза</label>
                        <select name="exp_ba">
                            <option value="Не была проведена" selected>Не была проведена</option>
                            <option value="Проведена">Проведена</option>
                        </select>
                    </div> -->
                </div>
                <div class="facts_four_section">
                    <h2>Материалы</h2>

                    <input type="file" name="material_ba[]" multiple hidden>
                    <?php
                    $sql2 = "SELECT * FROM `material_banknote` WHERE numb_mba = " . $bank['material_num_ba'];
                    $cep  = $mysqli->query($sql2);
                    if ($cep > 0) {
                        $cep = mysqli_fetch_all($cep);
                        foreach ($cep as $num) {
                            echo '
                            <div style="text-align: left;"><a style="text-decoration:none;" href="' . $num[2] . '">Ссылка на изображение</a></div>
                                                                   
                                    ';
                        };
                    } else {
                        echo 'Проверьте введенные данные!!!';
                    };
                    ?>

                </div>
                <div class="facts_four_section">
                    <h2>Таблица Исследований</h2>
                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>ФИО Специалиста</th>
                                <th>Способ изготовления</th>
                                <th>Дата проведения исследования</th>
                                <th>Открыть</th>
                                <!-- <th>Удалить</th>
                                <th>Изменить</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cep = $mysqli->query("SELECT * FROM `expertise` WHERE num_ex = " . $bank['expert_num_ba']);
                            $cep = mysqli_fetch_all($cep);
                            $number = 0;
                            foreach ($cep as $num) {
                                echo '
                        <tr>
                            
                            <td>' . $num[2] . '</td>
                            <td>' . $num[3] . '</td>
                            <td>' . $num[5] . '</td>
                            <td>' . $num[4] . '</td>
                            <td><a class="button_table" href="/blocks/open_reestr_expert.php?num=' . $num[0] . '">Открыть</a></td>
                          
                        </tr>
                            
                            
                            ';
                            };
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>


        </form>

    </div>
    <!-- <td><a class="button_table" href="/blocks/update_reestr_expert.php?num=' . $num[0] . '">Изменить</a></td>
    <td><a class="button_table" href="/blocks/vendor/v_del_reestr_expert.php?num=' . $num[0] . '">Удалить</a></td> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="/js/banknote_val.js"></script>
    <script type="text/javascript" src="/js/open_reestr_banknote.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
</body>

</html>