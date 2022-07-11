<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `members` WHERE id_me = $num";
    // echo $sql1;
    //Выборка с банкнот
    $members  = $mysqli->query($sql1);
    $members = mysqli_fetch_assoc($members);
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
    <title>ЕРДР/УД</title>
</head>

<body>

    <!-- заголовок -->
    <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('../blocks/nav.php'); ?>

        <form action="uch_v.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Участник уголовного дела </h1>
            <div class="facts_sections">
                <div class="facts_one_frame">

                    <div class="facts_one_section">
                        <h2>ЕРДР/УД</h2>
                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" name="iin_me" value="<?= $members['iin_me'] ?>" /><button style="margin-left: 5px; visibility: hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="ln">Фамилия</label>
                            <input type="text" name="fam_me" value="<?= $members['fam_me'] ?>" /><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Имя</label>
                            <input type="text" name="name_me" value="<?= $members['name_me'] ?>" /><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Отчество</label>
                            <input type="text" name="otch_me" value="<?= $members['otch_me'] ?>" /><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Судимость</label>
                            <input type="text" name="sud_me" placeholder="Если судимостей несколько, записывайте через точку с запятой" value="<?= $members['sud_me'] ?>" /><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                    </div>

                    <div class="facts_two_section">
                        <h2 style="visibility: hidden;">Продолжение</h2>
                        <div class="field">
                            <label for="n">Адрес прописки</label>
                            <input type="text" name="adress_me" value="<?= $members['adress_me'] ?>" />
                        </div>
                        <div class="field">
                            <label for="ln">Тип документа</label>
                            <input id="dop_type" type="text" name="" value="<?= $members['type_doc_me'] ?>" hidden />
                            <select name="type_doc_me">
                                <option class="type_doc_me1" value="Удостоверение личности">Удостоверение личности</option>
                                <option class="type_doc_me1" value="Паспорт" selected>Паспорт</option>
                                <option class="type_doc_me1" value="Другое">Другое</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Серия</label>
                            <input type="text" name="ser_me" value="<?= $members['ser_me'] ?>" />
                        </div>
                        <div class="field">
                            <label for="a">Номер</label>
                            <input type="text" name="num_me" maxlength="8" value="<?= $members['num_me'] ?>" />
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <input id="dop_roleses" type="text" name="" value="<?= $members['role_me'] ?>" hidden />
                            <select name="role_me">
                                <option class="role_me1" value="Подозреваемый">Подозреваемый</option>
                                <option class="role_me1" value="Свидетель">Свидетель</option>
                                <option class="role_me1" value="Понятой" selected>Понятой</option>
                            </select>
                           
                        </div>

                    </div>
                </div>
            </div>
        </form>


    </div>
    <script>
        let dop_type = document.getElementById("dop_type");
        let type_doc_me1 = document.querySelectorAll(".type_doc_me1");

        let dop_roles = document.getElementById("dop_roleses");
        let role_me1 = document.querySelectorAll(".role_me1");

        function is_update_select(values_table, opt) {
            document.addEventListener("DOMContentLoaded", function() {
                opt.forEach((element) => {
                    if (element.value == values_table.value) {
                        element.setAttribute("selected", "selected");
                    }
                });
            });
        };

        is_update_select(dop_type, type_doc_me1);

        is_update_select(dop_roles, role_me1);
    </script>
</body>

</html>