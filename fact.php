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
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="/vendor/fact.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Сведения о факте обнаружения</h1>
            <!-- <p>Номер факта: 9300</p> -->
            <div class="facts_sections">
                <div class="facts_one_frame">

                    <div class="facts_one_section">
                        <h2>Место обнаружения подделки</h2>
                        <div class="field">
                            <label for="n">Место</label>
                            <input type="text" name="place_p" required />
                        </div>
                        <div class="field">
                            <label for="ln">Наименование объекта</label>
                            <input type="text" name="name_p" required />
                        </div>

                        <div class="field">
                            <label for="a">Район/Населенный пункт</label>
                            <input type="text" name="rn_p" id="rn" required />
                        </div>
                        <div class="field">
                            <label for="a">Улица</label>
                            <input type="text" name="street_p" id="street" required />
                        </div>
                        <div class="field">
                            <label for="a">Дом</label>
                            <input type="text" name="house_p" id="house" required />
                        </div>
                        <div class="field">
                            <label for="a">Квартира</label>
                            <input type="text" name="kv_p" required />
                        </div>
                        <div class="field">
                            <label for="a">Долгота</label>
                            <input type="text" name="dolg_p" id="dolg" required />
                        </div>
                        <div class="field">
                            <label for="a">Широта</label>
                            <input type="text" name="shir_p" id="shir" required /> 
                        </div>
                        <br><br>
                        <div id="map"></div>

                    </div>

                    <div class="facts_two_section">
                        <h2>Сведения о лице, сдавшем подделку</h2>
                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" name="iin_pa" class="iin_pa" required />
                        </div>
                        <div class="field">
                            <label for="ln">Имя</label>
                            <input type="text" name="name_pa" required />
                        </div>
                        <div class="field">
                            <label for="a">Фамилия</label>
                            <input type="text" name="fam_pa" required />
                        </div>
                        <div class="field">
                            <label for="n">Отчество</label>
                            <input type="text" name="otch_pa" required />
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <select name="role_pa" required>
                                <option value="Работник органов">Работник органов</option>
                                <option value="Свидетель" selected>Свидетель</option>
                                <option value="Работник банка">Работник банка</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Место работы</label>
                            <input type="text" name="placework_pa" required />
                        </div>
                        <div class="field">
                            <label for="n">Должность</label>
                            <input type="text" name="dolg_pa" required />
                        </div>
                        <hr>
                        <div class="field">
                            <label for="ln">Риски СЦ</label>
                            <input type="text" name="risk_pa" required value="none"/>
                        </div>
                        <div class="field">
                            <label for="a">БД "Посетители лиц отбвающих наказание в ИУ"</label>
                            <input type="text" name="bd_plo_pa" required value="none"/>
                        </div>
                        <div class="field">
                            <label for="n">БД "Лица отбывающие наказание в ИУ"</label>
                            <input type="text" name="bd_lon_pa" required value="none"/>
                        </div>
                        <div class="field">
                            <label for="ln">БД "Лица ранее осужденные по 206 ст"</label>
                            <input type="text" name="bd_lro_pa" required value="none"/>
                        </div>
                        <div class="field">
                            <label for="" id="">Анфас</label>
                            <input type="file" name="anfas_pa" id="pct" required />
                            <p for="" id="pct_l"></p>
                        </div>
                        <div class="field">
                            <label for="a">Профиль</label>
                            <input type="file" name="profile_pa" id="pct1" required />
                            <p for="" id="pct_l1"></p>
                        </div>
                        <div class="field">
                            <label for="a">Дактокарта</label>
                            <input type="file" name="dakt_pa" id="pct2" required />
                            <p for="" id="pct_l2"></p>
                        </div>
                    </div>
                </div>
                <div class="facts_three_section">
                    <h2>Сведения о регистрации</h2>
                    <div class="field">
                        <label for="n">ФИО сотрудника</label>
                        <input type="text" name="fio_re" required />
                    </div>
                    <div class="field">
                        <label for="ln">Должность</label>
                        <input type="text" name="dolg_re" required value="<?= $_SESSION["user"]["role"] ?>"/>
                    </div>            
                    <div class="field">
                        <label for="a">Дата поступления информации</label>
                        <input type="date" name="date_re" required />
                    </div>
                    <div class="field">
                        <label for="a">Обстоятельства</label>
                        <select name="obst_re" required>
                            <option value="В ходе ОРМ">В ходе ОРМ</option>
                            <option value="От органов УВД">От органов УВД</option> 
                            <option value="От физ. лиц">От физ. лиц</option>
                            <option value="От юр. лиц">От юр. лиц</option>
                            <option value="По сообщению банка" selected>По сообщению банка</option>
                            <option value="Разовый сбыт">Разовый сбыт</option>
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



            </div>
            <input type="submit" value="Отправить" style="margin-bottom: 20px; width: 100%; margin-top:20px;">

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaCEckEfWrmRurAosjxEF4HMvuEijUgDE&callback=initMap&v=weekly" defer></script>
    <script src="/js/map.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
    <script>
        function checkingNumber(input) {
            input.value = input.value.replace(/[^\d]/g, '').substr(0, 12);
        };

        $('.iin_pa').on('keyup', function() {
            checkingNumber(this);
        });
    </script>

</body>

</html>