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
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.theme.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>ЕРДР/УД</title>
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
    <?php require('../blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('../blocks/nav.php'); ?>

        <form action="resh_v.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Принятое по делу решение</h1>
            
            <div class="facts_sections">
                <div class="facts_one_frame">
                    <div class="facts_one_section">
                        <h2>Общие данные</h2>
                        <div class="field">
                            <label for="ln">Резолюция</label>
                            <select name="rez_re" id="rez_re" required>
                                <option value="Выберите значение" selected id="null_zn"></option>
                                <option value="Возбуждено УД">Возбуждено УД</option>
                                <option value="Уголовное дело на стадии расследования">Уголовное дело на стадии расследования</option>
                                <option value="Переквалифицировано">Переквалифицировано</option>
                                <option value="Присоединено к УД">Присоединено к УД</option>
                                <option value="Уголовное дело приостановлено">Уголовное дело приостановлено</option>
                                <option value="Уrоловное дело возобновлено">Уrоловное дело возобновлено</option>
                                <option value="Уголовное дело прекращено">Уголовное дело прекращено</option>
                                <option value="Направлено в суд">Направлено в суд</option>
                                <option value="Решение суда">Решение суда</option>
                            </select>
                        </div>
                        <div class="field">
                            <label for="n">Квалификация УК РК</label>
                            <input type="text" name="kval_re" id="kval_re" required />
                        </div>
                        <div class="field">
                            <label for="ln">Статья УПК РК</label>
                            <input type="text" name="stat_re" id="stat_re" required />
                        </div>
                        <div class="field">
                            <label for="a">Дата принятия решения</label>
                            <input type="date" name="date_re" id="date_re" required />
                        </div>
                    </div>
                    <div class="facts_two_section">
                        <h2 style="visibility: hidden;">Продолжение</h2>
                        <div class="field">
                            <label for="n">Переквалификация</label>
                            <input type="text" name="perkval_re" id="perkval_re" required />
                        </div>
                        <div class="field">
                            <label for="a">№ УД (присоединения)</label>
                            <input type="number" name="num_pr_re" id="num_pr_re" required style="padding: 6px 0 4px 10px;  border: 1px solid #cecece;  background: #f6f6f6;  border-radius: 8px;" />
                        </div>
                        <div class="field">
                            <label for="a">Дата ВУД (присоединения)</label>
                            <input type="date" name="date_vud_re" id="date_vud_re" required />
                        </div>
                        <div class="field">
                            <label for="a">Решение суда</label>
                            <input type="text" name="resh_re" id="resh_re" required />
                        </div>

                    </div>
                </div>
                <div class="facts_two_section">
                    <h2>Фабула</h2>
                    <textarea name="fab_re" id="" cols="100" rows="10" required></textarea>
                </div>
                <div class="facts_four_section">
                    <h2>Вложение</h2>
                    <input type="file" name="material_re[]" multiple required id="gallery-photo-add">
                    <div class="gallery" id="galer"></div>
                </div>
            </div>

            <input type="submit" value="Отправить" style="margin-top: 10px; margin-bottom: 10px;">
            <a class="buttons" href="../erdr.php" style="margin-left: 5px;">Далее</a>
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
    <script type="text/javascript" src="/js/resh.js"></script>
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
</body>

</html>