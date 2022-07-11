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
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.theme.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фактов обнаружения</title>
</head>

<body>
    <style>
        #pct_l,
        #pct_l1,
        #pct_l2 {
            display: none;
            width: 20px;
            height: 12em;
            background: silver;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        #map {
            height: 400px;
            width: auto;
        }
    </style>
    <!-- заголовок -->
    <?php require('header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>
        <form action="/blocks/vendor/v_update_reestr_facts.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Сведения о факте обнаружения</h1>
            <p>Номер факта: <?= $fact['number'] ?></p>
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">
                        <h2>Место обнаружения подделки</h2>
                        <div class="field" style="display: none;">
                            <label for="n">Ссылка</label>
                            <input type="text" name="ref" value="<?= $num ?>" readonly />
                        </div>
                        <div class="field" style="display: none;">
                            <label for="n">Идентификатор</label>
                            <input type="text" name="id" value="<?= $place['id'] ?>" readonly />
                        </div>
                        <div class="field">
                            <label for="n">Место</label>
                            <input type="text" name="place_p" value="<?= $place['place_p'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Наименование объекта</label>
                            <input type="text" name="name_p" value="<?= $place['name_p'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="a">Район/Населенный пункт</label>
                            <input type="text" name="rn_p" value="<?= $place['rn_p'] ?>" id="rn" required/>
                        </div>
                        <div class="field">
                            <label for="a">Улица</label>
                            <input type="text" name="street_p" value="<?= $place['street_p'] ?>" id="street" required/>
                        </div>
                        <div class="field">
                            <label for="a">Дом</label>
                            <input type="text" name="house_p" value="<?= $place['house_p'] ?>" id="house" required/>
                        </div>
                        <div class="field">
                            <label for="a">Квартира</label>
                            <input type="text" name="kv_p" value="<?= $place['kv_p'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="a">Долгота</label>
                            <input type="text" name="dolg_p" value="<?= $place['dolg_p'] ?>" id="dolg" required/>
                        </div>
                        <div class="field">
                            <label for="a">Широта</label>
                            <input type="text" name="shir_p" value="<?= $place['shir_p'] ?>" id="shir" required/>
                        </div>
                        <br><br>
                        <div id="map"></div>
                    </div>

                    <div class="facts_two_section">
                        <h2>Сведения о лице, сдавшем подделку</h2>
                        <div class="field" style="display: none;">
                            <label for="n">Идентификатор</label>
                            <input type="text" name="id_pa" value="<?= $passed['id_pa'] ?>" readonly />
                        </div>
                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" class="iin_pa" name="iin_pa" value="<?= $passed['iin_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Имя</label>
                            <input type="text" name="name_pa" value="<?= $passed['name_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="a">Фамилия</label>
                            <input type="text" name="fam_pa" value="<?= $passed['fam_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="n">Отчество</label>
                            <input type="text" name="otch_pa" value="<?= $passed['otch_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <input id="dop_role" type="text" name="" value="<?= $passed['role_pa'] ?>" hidden />
                            <select name="role_pa" id="role_pa" required>
                                <option id="role_pa1" value="Работник органов">Работник органов</option>
                                <option id="role_pa2" value="Свидетель">Свидетель</option>
                                <option id="role_pa3" value="Работник банка">Работник банка</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Место работы</label>
                            <input type="text" name="placework_pa" value="<?= $passed['placework_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="n">Должность</label>
                            <input type="text" name="dolg_pa" value="<?= $passed['dolg_pa'] ?>" required/>
                        </div>
                        <hr>
                        <div class="field">
                            <label for="ln">Риски СЦ</label>
                            <input type="text" name="risk_pa" value="<?= $passed['risk_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="a">БД "Посетители лиц отбвающих наказание в ИУ"</label>
                            <input type="text" name="bd_plo_pa" value="<?= $passed['bd_plo_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="n">БД "Лица отбывающие наказание в ИУ"</label>
                            <input type="text" name="bd_lon_pa" value="<?= $passed['bd_lon_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="ln">БД "Лица ранее осужденные по 206 ст"</label>
                            <input type="text" name="bd_lro_pa" value="<?= $passed['bd_lro_pa'] ?>" required/>
                        </div>
                        <div class="field">
                            <label for="a">Анфас</label>
                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="3000000000" /> -->
                            <input type="file" name="anfas_pa" id="pct" />
                            <div style="width:69%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['anfas_pa'] ?>">Ссылка на изображение</a></div>
                            <p for="" id="pct_l"></p>
                        </div>
                        <div class="field">
                            <label for="a">Профиль</label>
                            <input type="file" name="profile_pa" id="pct1"/>
                            <div style="width:69%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['profile_pa'] ?>">Ссылка на изображение</a></div>
                            <p for="" id="pct_l1"></p>
                        </div>
                        <div class="field">
                            <label for="a">Дактокарта</label>
                            <input type="file" name="dakt_pa" id="pct2" />
                            <div style="width:69%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['dakt_pa'] ?>">Ссылка на изображение</a></div>
                            <p for="" id="pct_l2"></p>
                        </div>
                    </div>
                </div>
                <div class="facts_three_section">
                    <h2>Сведения о регистрации</h2>
                    <div class="field" style="display: none;">
                        <label for="n">Идентификатор</label>
                        <input type="text" name="id_re" value="<?= $regist['id_re'] ?>" readonly />
                    </div>
                    <div class="field">
                        <label for="n">ФИО сотрудника</label>
                        <input type="text" name="fio_re" value="<?= $regist['fio_re'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Должность</label>
                        <input type="text" name="dolg_re" value="<?= $regist['dolg_re'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="a">Дата поступления информации</label>
                        <input type="date" name="date_re" value="<?= $regist['date_re'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="a">Обстоятельства</label>
                        <input id="dop_obst" type="text" name="" value="<?= $regist['obst_re'] ?>" hidden />
                        <select name="obst_re" required>
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
                                <th>Изменить</th>
                                <th>Удаление</th>
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
                            <td><a class="button_table" href="/blocks/update_reestr_cep.php?number=' . $num[0] . '">Изменить</a></td>
                            <td><a class="button_table" href="/blocks/vendor/v_del_reestr_cep.php?number=' . $num[0] . '">Удалить</a></td>
                        </tr>
                            
                            
                            ';
                            };
                            ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <input style="cursor: pointer;" type="submit" value="Изменить">
        </form>

    </div>
    <script>
        document.querySelector("#pct").addEventListener("change", function() {
            if (this.files[0]) {
                var fr = new FileReader();

                fr.addEventListener("load", function() {
                    document.querySelector("#pct_l").style.display = 'block';
                    document.querySelector("#pct_l").style.backgroundImage = "url(" + fr.result + ")";
                }, false);

                fr.readAsDataURL(this.files[0]);
            }
        });

        document.querySelector("#pct1").addEventListener("change", function() {
            if (this.files[0]) {
                var fr = new FileReader();

                fr.addEventListener("load", function() {
                    document.querySelector("#pct_l1").style.display = 'block';
                    document.querySelector("#pct_l1").style.backgroundImage = "url(" + fr.result + ")";
                }, false);

                fr.readAsDataURL(this.files[0]);
            }
        });

        document.querySelector("#pct2").addEventListener("change", function() {
            if (this.files[0]) {
                var fr = new FileReader();

                fr.addEventListener("load", function() {
                    document.querySelector("#pct_l2").style.display = 'block';
                    document.querySelector("#pct_l2").style.backgroundImage = "url(" + fr.result + ")";
                }, false);

                fr.readAsDataURL(this.files[0]);
            }
        });
    </script>
    <script type="text/javascript" src="/js/open_reestr_facts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaCEckEfWrmRurAosjxEF4HMvuEijUgDE&callback=initMap&v=weekly" defer></script>
    <script src="/js/map.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
    <script>
        function checkingNumber(input) {
            input.value = input.value.replace(/[^\d]/g, '').substr(0, 10);
        };

        $('.iin_pa').on('keyup', function() {
            checkingNumber(this);
        });
    </script>
</body>

</html>