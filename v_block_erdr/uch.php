<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once '../vendor/settings.php';
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
            <h1 class="title_main">Участник уголовного дела</h1>

            <div class="facts_sections">
                <div class="facts_one_frame">

                    <div class="facts_one_section">
                        <h2>ЕРДР/УД</h2>
                        <div class="field">
                            <label for="n">ИИН</label>
                            <input type="text" name="iin_me" minlength="10" class="iin_pa" required/><button style="margin-left: 5px; appearance: none;  -webkit-appearance: none;  /* usual styles */  padding: 5px;  border: none;  background-color: #3f51b5;  color: #fff;  border-radius: 5px; cursor: pointer;  text-decoration: none;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="ln">Фамилия</label>
                            <input type="text" name="fam_me" required/><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Имя</label>
                            <input type="text" name="name_me" required/><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Отчество</label>
                            <input type="text" name="otch_me" required/><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                        <div class="field">
                            <label for="a">Судимость</label>
                            <input type="text" name="sud_me" value="Отсутствует" placeholder="Если судимостей несколько, записывайте через точку с запятой" required/><button style="margin-left: 5px; visibility:hidden;">Поиск</button>
                        </div>
                    </div>

                    <div class="facts_two_section">
                        <h2 style="visibility: hidden;">Продолжение</h2>
                        <div class="field">
                            <label for="n">Адрес прописки</label>
                            <input type="text" name="adress_me" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Тип документа</label>
                            <select name="type_doc_me" required>
                                <option value="Удостоверение личности" selected>Удостоверение личности</option>
                                <option value="Паспорт">Паспорт</option>
                                <option value="Другое">Другое</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="a">Серия</label>
                            <input type="text" name="ser_me" required/>
                        </div>
                        <div class="field">
                            <label for="a">Номер</label>
                            <input type="text" name="num_me" maxlength="8" required/>
                        </div>
                        <div class="field">
                            <label for="ln">Роль</label>
                            <select name="role_me" required>
                                <option value="Подозреваемый" selected>Подозреваемый</option>
                                <option value="Свидетель">Свидетель</option>
                                <option value="Понятой">Понятой</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <input style="margin-top: 10px; margin-bottom: 10px;" type="submit" value="Отправить"><a class="buttons" href="../erdr.php" style="margin-left: 5px;">Далее</a>
        </form>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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