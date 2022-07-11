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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.theme.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фактов обнаружения</title>
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

        <form action="/vendor/expertise.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Добавление исследования</h1>
            
            <div class="facts_four_section">
                <h2>Таблица исследований</h2>
                

                <table id="userTable" class="cell-border hover row-border" style="width:100%"> 
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>ФИО Специалиста</th>
                            <th>Способ изготовления</th>
                            <th>Дата проведения экспертизы</th>
                            <th>Открыть</th>
                            <th>Удалить</th>
                            <th>Изменить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $max_id = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
                        $nummain = mysqli_fetch_all($max_id);
                        foreach ($nummain as $nus) {
                            $max_id = $nus[0];
                        };
                        $cep = $mysqli->query("SELECT * FROM `expertise` WHERE num_ex = '$max_id'");
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
                            <td><a class="button_table" href="/blocks/update_reestr_expert.php?num=' . $num[0] . '">Изменить</a></td>
                            <td><a class="button_table" href="/blocks/vendor/v_del_reestr_expert.php?num=' . $num[0] . '">Удалить</a></td> 
                        </tr>
                            
                            
                            ';
                        };
                        ?>

                    </tbody>
                </table>

            </div>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Специалист</h2>
                    <div class="field">
                        <label for="n">№ Исследования</label>
                        <input type="text" name="nom_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Специалист (ФИО)</label>
                        <input type="text" name="fio_ex" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Дата исследования</label>
                        <input type="date" name="date_ex" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Признаки</h2>
                    <div class="field">
                        <label for="n">Способ изготовления</label>
                        <input type="text" name="spos_ex" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Атрибуты</h2>
                    <div class="field">
                        <label for="n">Цвет</label>
                        <input type="text" name="color_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Длина</label>
                        <input type="text" name="dlina_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Толщина</label>
                        <input type="text" name="tols_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Люминесценция</label>
                        <input type="text" name="lumen_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Облачность</label>
                        <input type="text" name="obl_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Характер поверхности</label>
                        <input type="text" name="xarp_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Высота</label>
                        <input type="text" name="height_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Защитная нить</label>
                        <input type="text" name="shield_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Филигрань</label>
                        <input type="text" name="fil_ex" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Средства защиты</h2>
                    <div class="field">
                        <label for="n">Водяные знаки</label>
                        <input type="text" name="water_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Совмещающиеся изображения</label>
                        <input type="text" name="sovmimg_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Метки для людей с ослабленным зрением</label>
                        <input type="text" name="met_ex" required/>
                    </div>
                    <div class="field">
                        <label for="n">Оптически изменяющаяся краска</label>
                        <input type="text" name="opt_ex" required/>
                    </div>
                </div>
                <div class="facts_four_section">
                    <h2>Приложения</h2>
                    <input type="file" name="material_ex[]" multiple id="gallery-photo-add" required>
                    <div class="gallery" id="galer"></div>
                </div>
            </div>
            <input type="submit" value="Отправить" style="margin-top: 10px; margin-bottom: 10px;"><a class="buttons" href="/banknote.php" style="margin-left: 5px;">Далее</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>

   
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
</body>

</html>