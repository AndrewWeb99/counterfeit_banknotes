<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `passed` WHERE id_pa = $num";
    // echo $sql1;
    //Выборка с банкнот
    $passed  = $mysqli->query($sql1);
    $passed = mysqli_fetch_assoc($passed);
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
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фактов участников</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('../blocks/nav.php'); ?>

        <form action="/vendor/fact.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Реестр фактов участников</h1>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Сведения о лице, сдавшем подделку</h2>
                    <div class="field">
                        <label for="n">ИИН</label>
                        <input type="text" name="iin_pa" value="<?= $passed['iin_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="ln">Имя</label>
                        <input type="text" name="name_pa" value="<?= $passed['name_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="a">Фамилия</label>
                        <input type="text" name="fam_pa" value="<?= $passed['fam_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="n">Отчество</label>
                        <input type="text" name="otch_pa" value="<?= $passed['otch_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="ln">Роль</label>
                        <input id="dop_rol" type="text" name="" value="<?= $passed['role_pa'] ?>" hidden />
                        <select name="role_pa">
                            <option id="role_pa1" value="Работник органов">Работник органов</option>
                            <option id="role_pa2" value="Свидетель">Свидетель</option>
                            <option id="role_pa3" value="Работник банка">Работник банка</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="a">Место работы</label>
                        <input type="text" name="placework_pa" value="<?= $passed['placework_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="n">Должность</label>
                        <input type="text" name="dolg_pa" value="<?= $passed['dolg_pa'] ?>" />
                    </div>
                    <hr>
                    <div class="field">
                        <label for="ln">Риски СЦ</label>
                        <input type="text" name="risk_pa" value="<?= $passed['risk_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="a">БД "Посетители лиц отбвающих наказание в ИУ"</label>
                        <input type="text" name="bd_plo_pa" value="<?= $passed['bd_plo_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="n">БД "Лица отбывающие наказание в ИУ"</label>
                        <input type="text" name="bd_lon_pa" value="<?= $passed['bd_lon_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="ln">БД "Лица ранее осужденные по 206 ст"</label>
                        <input type="text" name="bd_lro_pa" value="<?= $passed['bd_lro_pa'] ?>" />
                    </div>
                    <div class="field">
                        <label for="a">Анфас</label>
                        <input type="file" name="anfas_pa" hidden/>
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['anfas_pa'] ?>">Ссылка на изображение</a></div>
                    </div>
                    <div class="field">
                        <label for="a">Профиль</label>
                        <input type="file" name="profile_pa" hidden/>
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['profile_pa'] ?>">Ссылка на изображение</a></div>
                    </div>
                    <div class="field">
                        <label for="a">Дактокарта</label>
                        <input type="file" name="dakt_pa" hidden/>
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration: none;" href="<?= $passed['dakt_pa'] ?>">Ссылка на изображение</a></div>
                    </div>
                </div>



            </div>


        </form>


    </div>
    <script src="/js/open_reestr_uch_passed.js"></script>
</body>

</html>