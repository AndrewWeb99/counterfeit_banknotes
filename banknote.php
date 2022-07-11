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
    <title>Добавление данных о подделке</title>
</head>

<body>
    <style>
        .gallery {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .gallery img {
            border: 2px solid black;
            margin-right: 10px;
            width: 15%;
        }
    </style>
    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>

        <form action="/vendor/banknote.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Данные подделки</h1>

            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Общие данные</h2>
                    <div class="field">
                        <label for="ln">Тип</label>
                        <select name="type_ba" id="type_ba" >
                            <option value="Банкнота" selected>Банкнота</option>
                            <option value="Монета">Монета</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Валюта</label>
                        <select name="val_ba" id="val_ba" >
                            <option value="Тенге" selected>Тенге</option>
                            <option value="Рубль">Рубль</option>
                            <option value="Евро">Евро</option>
                            <option value="Доллар">Доллар</option>
                            <option value="Другое">Другое</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Сувенир</label>
                        <select name="suven_ba" id="suven_ba" >
                            <option value="Да">Да</option>
                            <option value="Нет" selected>Нет</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="ln">Комбинация</label>
                        <select name="combo_ba" id="combo_ba" >
                            <option value="Обычная">Обычная</option>
                            <option value="Половинчатая" selected>Половинчатая</option>
                            <option value="Подлинная">Подлинная</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="n">Серия</label>
                        <input type="text" name="ser_one_ba" id="ser_one_ba" value="0" maxlength="2" />
                    </div>
                    <div class="field">
                        <label for="n">Серия 2</label>
                        <input type="text" name="ser_two_ba" id="ser_two_ba" value="0" maxlength="2" />
                    </div>
                    <div class="field">
                        <label for="ln">Номер</label>
                        <input type="text" name="number_one_ba" id="number_one_ba" value="0" maxlength="2" />
                    </div>
                    <div class="field">
                        <label for="ln">Номер 2</label>
                        <input type="text" name="number_two_ba" id="number_two_ba" value="0" maxlength="2" />
                    </div>
                    <div class="field">
                        <label for="ln">Год выпуска</label>
                        <input type="date" name="date_ba" id="date_ba" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Номинал</label>
                        <select name="nominal_ba" id="nominal_ba" required>
                            <option value="200" selected>200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                            <option value="5000">5000</option>
                            <option value="10000">10000</option>
                            <option value="20000">20000</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="a">Количество</label>
                        <input type="text" name="kol_ba" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Материалы</label>
                        <input type="file" name="material_ba[]" multiple id="gallery-photo-add" required>
                        <div class="gallery" id="galer"></div>
                    </div>
                    <!-- <div class="field">
                        <label for="ln">Экспертиза</label>
                        <select name="exp_ba">
                            <option value="Не была проведена" selected>Не была проведена</option>
                            <option value="Проведена">Проведена</option>
                        </select>
                    </div> -->
                </div>
            </div>
            <input type="submit" value="Отправить" style="margin-top: 10px; margin-bottom: 10px;">
            <a class="buttons" href="erdr.php" style="margin-left: 5px;">Далее</a>
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
    <script>
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);

                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                $('#galer').empty();
                imagesPreview(this, 'div.gallery');
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="/js/banknote_val.js"></script>
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
</body>

</html>