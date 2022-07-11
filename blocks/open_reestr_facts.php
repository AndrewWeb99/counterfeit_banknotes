<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `facts` WHERE number = $num";
    // echo $sql1;
    //Выборка с главной
    $fact  = $mysqli->query($sql1);
    $fact = mysqli_fetch_assoc($fact);
    //Выборка с места обнаружения
    $sql1 = "SELECT * FROM `place` WHERE id = " . $fact['place'];
    $place  = $mysqli->query($sql1);
    $place = mysqli_fetch_assoc($place);
    //Выборка сведения о лице
    $sql1 = "SELECT * FROM `passed` WHERE id_pa = " . $fact['passed'];
    $passed  = $mysqli->query($sql1);
    $passed = mysqli_fetch_assoc($passed);
    // Выборка сведения о регистрации
    $sql1 = "SELECT * FROM `regist` WHERE id_re = " . $fact['regsit'];
    $regist  = $mysqli->query($sql1);
    $regist = mysqli_fetch_assoc($regist);
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
    <title>Реестр фактов обнаружения</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>
        <form action="#" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Сведения о факте обнаружения</h1>
            <p>Номер факта: <?= $fact['number'] ?></p>
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">
                        <h2>Место обнаружения подделки</h2>
                        <div class="field">
                            <label for="n">Место</label>
                            <input type="text" name="place_p" value="<?= $place['place_p'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="ln">Наименование объекта</label>
                            <input type="text" name="name_p" readonly value="<?= $place['name_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Район/Населенный пункт</label>
                            <input type="text" name="rn_p" readonly value="<?= $place['rn_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Улица</label>
                            <input type="text" name="street_p" readonly value="<?= $place['street_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Дом</label>
                            <input type="text" name="house_p" readonly value="<?= $place['house_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Квартира</label>
                            <input type="text" name="kv_p" readonly value="<?= $place['kv_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Долгота</label>
                            <input type="text" name="dolg_p" readonly value="<?= $place['dolg_p'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Широта</label>
                            <input type="text" name="shir_p" readonly value="<?= $place['shir_p'] ?>" />
                        </div>


                    </div>

                    <div class="facts_two_section">
                        <h2>Сведения о лице, сдавшем подделку</h2>
                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" name="iin_pa" value="<?= $passed['iin_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="ln">Имя</label>
                            <input type="text" name="name_pa" value="<?= $passed['name_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="a">Фамилия</label>
                            <input type="text" name="fam_pa" value="<?= $passed['fam_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="n">Отчество</label>
                            <input type="text" name="otch_pa" value="<?= $passed['otch_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <input id="dop_role" type="text" name="" value="<?= $passed['role_pa'] ?>" hidden />
                            <select name="role_pa" id="role_pa" disabled>
                                <option id="role_pa1" value="Работник органов">Работник органов</option>
                                <option id="role_pa2" value="Свидетель">Свидетель</option>
                                <option id="role_pa3" value="Работник банка">Работник банка</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Место работы</label>
                            <input type="text" name="placework_pa" value="<?= $passed['placework_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="n">Должность</label>
                            <input type="text" name="dolg_pa" value="<?= $passed['dolg_pa'] ?>" readonly/>
                        </div>
                        <hr>
                        <div class="field">
                            <label for="ln">Риски СЦ</label>
                            <input type="text" name="risk_pa" value="<?= $passed['risk_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="a">БД "Посетители лиц отбвающих наказание в ИУ"</label>
                            <input type="text" name="bd_plo_pa" value="<?= $passed['bd_plo_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="n">БД "Лица отбывающие наказание в ИУ"</label>
                            <input type="text" name="bd_lon_pa" value="<?= $passed['bd_lon_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="ln">БД "Лица ранее осужденные по 206 ст"</label>
                            <input type="text" name="bd_lro_pa" value="<?= $passed['bd_lro_pa'] ?>" readonly/>
                        </div>
                        <div class="field">
                            <label for="a">Анфас</label>
                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" /> -->
                            <input type="file" name="anfas_pa" hidden />
                            <div style="width:69%; margin-right: 0px;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['anfas_pa'] ?>">Ссылка на изображение</a></div>
                        </div>
                        <div class="field">
                            <label for="a">Профиль</label>
                            <input type="file" name="profile_pa" hidden />
                            <div style="width:69%; margin-right: 0px;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['profile_pa'] ?>">Ссылка на изображение</a></div>
                        </div>
                        <div class="field">
                            <label for="a">Дактокарта</label>
                            <input type="file" name="dakt_pa" hidden />
                            <div style="width:69%; margin-right: 0px;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['dakt_pa'] ?>">Ссылка на изображение</a></div>
                        </div>
                    </div>
                </div>
                <div class="facts_three_section">
                    <h2>Сведения о регистрации</h2>
                    <div class="field">
                        <label for="n">ФИО сотрудника</label>
                        <input type="text" name="fio_re" value="<?= $regist['fio_re'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Должность</label>
                        <input type="text" name="dolg_re" value="<?= $regist['dolg_re'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Дата поступления информации</label>
                        <input type="date" name="date_re" value="<?= $regist['date_re'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Обстоятельства</label>
                        <input id="dop_obst" type="text" name="" value="<?= $regist['obst_re'] ?>" hidden />
                        <select name="obst_re" disabled>
                            <option id="obst_re1" value="В ходе ОРМ">В ходе ОРМ</option>
                            <option id="obst_re2" value="От органов УВД">От органов УВД</option>
                            <option id="obst_re3" value="От физ. лиц">От физ. лиц</option>
                            <option id="obst_re4" value="От юр. лиц">От юр. лиц</option>
                            <option id="obst_re5" value="По сообщению банка">По сообщению банка</option>
                            <option id="obst_re6" value="Разовый сбыт">Разовый сбыт</option>
                        </select>
                    </div>
                    <div class="field" style="visibility: hidden;">
                        <label for="a">Наличие участников цепочки</label>
                        <select name="cep_re">
                            <option value="Есть" selected>Есть</option>
                            <option value="Отсутствуют">Отсутствуют</option>
                        </select>
                    </div>
                </div>
                <div class="facts_four_section">
                    <h2>Цепочка возникновения подделки</h2>
                    <table id="userTable" class="cell-border hover row-border" style="width:100%">
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Дата</th>
                                <th>Адрес обнаружения</th>
                                <th>Место обнаружения</th>
                                <th>ИИН участника</th>
                                <th>ФИО участника</th>
                                <th>Роль участника</th>
                                <th>Открыть</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $cep = $mysqli->query("SELECT * FROM `chain` WHERE numb_ch = '$num'");
                            $cep = mysqli_fetch_all($cep);
                            $number = 0;
                            foreach ($cep as $num) {
                                $number++;
                                echo '
                        <tr>
                            <td>' . $number . '</td>
                            <td>' . $num[10] . '</td>
                            <td>' . $num[16] . ', ' . $num[17] . ', ' . $num[18] . '</td>
                            <td>' . $num[15] . '</td>
                            <td>' . $num[3] . '</td>
                            <td>' . $num[4] . ' ' . $num[5] . ' ' . $num[6] . '</td>
                            <td>' . $num[9] . '</td> 
                            <td><a class="button_table" href="/blocks/open_reestr_cep.php?number=' . $num[0] . '">Открыть</a></td>
                            
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
    <!-- <td><a class="button_table" href="/blocks/update_reestr_cep.php?number='.$num[0].'">Изменить</a></td>
    <td><a class="button_table" href="/blocks/vendor/v_del_reestr_cep.php?number='.$num[0].'">Удалить</a></td> -->
    <script type="text/javascript" src="/js/open_reestr_facts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
</body>

</html>