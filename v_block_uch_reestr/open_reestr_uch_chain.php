<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}

require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `chain` WHERE id_ch = $num";
    // echo $sql1;
    //Выборка с банкнот
    $chain  = $mysqli->query($sql1);
    $chain = mysqli_fetch_assoc($chain);
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
    <title>Реестр участников</title>
</head>

<body>
    <!-- заголовок -->
    <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('../blocks/nav.php'); ?>

        <form action="/vendor/cep.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Реестр участников</h1>

            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Сведения о том, кто передал подделку</h2>
                    <div class="field">
                        <label for="ln">В отношении</label>
                        <input id="dop_ust" type="text" name="" value="<?= $chain['ust_ch'] ?>" hidden />
                        <select name="ust_ch" disabled>
                            <option id="ust_ch1" value="Установленное лицо">Установленное лицо</option>
                            <option id="ust_ch2" value="Неустановленное лицо">Неустановленное лицо</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="n">ИИН </label>
                        <input type="text" name="iin_ch" value="<?= $chain['iin_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Фамилия</label>
                        <input type="text" name="fam_ch" value="<?= $chain['fam_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Имя</label>
                        <input type="text" name="name_ch" value="<?= $chain['name_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="n">Отчество</label>
                        <input type="text" name="otch_ch" value="<?= $chain['otch_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="n">Место работы</label>
                        <input type="text" name="place_ch" value="<?= $chain['place_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="n">Должность</label>
                        <input type="text" name="work_ch" value="<?= $chain['work_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Роль</label>
                        <input id="dop_roles" type="text" name="" value="<?= $chain['role_ch'] ?>" hidden />
                        <select name="role_ch" disabled>
                            <option id="role_ch1" value="Обвиняемый">Обвиняемый</option>
                            <option id="role_ch2" value="Свидетель" selected>Свидетель</option>
                        </select>
                    </div>
                </div>

        </form>



    </div>
    <script>
        let ust_ch1 = document.getElementById("ust_ch1");
        let ust_ch2 = document.getElementById("ust_ch2");
        let dop_ust = document.getElementById("dop_ust");

        let role_ch1 = document.getElementById("role_ch1");
        let role_ch2 = document.getElementById("role_ch2");
        let dop_roles = document.getElementById("dop_roles");

        document.addEventListener("DOMContentLoaded", function() {
            if (dop_ust.value == "Установленное лицо") {
                ust_ch1.setAttribute("selected", "selected");
            } else if (dop_ust.value == "Неустановленное лицо") {
                ust_ch2.setAttribute("selected", "selected");
            } 

            if (dop_roles.value == "Обвиняемый") {
                role_ch1.setAttribute("selected", "selected");
            } else if (dop_roles.value == "Свидетель") {
                role_ch2.setAttribute("selected", "selected");
            } 
        });
    </script>
</body>

</html>