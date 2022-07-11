<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}

require_once '../vendor/settings.php';
if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `expertise` WHERE id_ex = $num";
    // echo $sql1;
   
    //Выборка с экспертизы
    $exp  = $mysqli->query($sql1);
    $exp = mysqli_fetch_assoc($exp); 
       
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
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.css">
    <link rel="stylesheet" href="/form_styler/jquery.formstyler.theme.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Исследования</title>
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
    <?php require('header.php'); ?> 
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>

        <form action="/blocks/vendor/v_update_reestr_expert.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Исследование</h1>
           
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Специалист</h2>
                    <div class="field" style="display: none;">
                        <label for="n">№</label>
                        <input type="text" name="id_ex" value="<?= $exp['id_ex'] ?>"/>
                    </div>
                    <div class="field" style="display: none;">
                        <label for="n">Img</label>
                        <input type="text" name="pril_num_ex" value="<?= $exp['pril_num_ex'] ?>"/>
                    </div>
                    <div class="field">
                        <label for="n">№ Исследования</label>
                        <input type="text" name="nom_ex" value="<?= $exp['nom_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Специалист (ФИО)</label>
                        <input type="text" name="fio_ex" value="<?= $exp['fio_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Дата исследования</label>
                        <input type="date" name="date_ex" value="<?= $exp['date_ex'] ?>" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Признаки</h2>
                    <div class="field">
                        <label for="n">Способ изготовления</label>
                        <input type="text" name="spos_ex" value="<?= $exp['spos_ex'] ?>" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Атрибуты</h2>
                    <div class="field">
                        <label for="n">Цвет</label>
                        <input type="text" name="color_ex" value="<?= $exp['color_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Длина</label>
                        <input type="text" name="dlina_ex" value="<?= $exp['dlina_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Толщина</label>
                        <input type="text" name="tols_ex" value="<?= $exp['tols_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Люминесценция</label>
                        <input type="text" name="lumen_ex" value="<?= $exp['lumen_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Облачность</label>
                        <input type="text" name="obl_ex" value="<?= $exp['obl_ex'] ?>" required />
                    </div>
                    <div class="field">
                        <label for="n">Характер поверхности</label>
                        <input type="text" name="xarp_ex" value="<?= $exp['xarp_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Высота</label>
                        <input type="text" name="height_ex" value="<?= $exp['height_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Защитная нить</label>
                        <input type="text" name="shield_ex" value="<?= $exp['shield_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Филигрань</label>
                        <input type="text" name="fil_ex" value="<?= $exp['fil_ex'] ?>" required/>
                    </div>
                </div>

                <div class="facts_four_section">
                    <h2>Средства защиты</h2>
                    <div class="field">
                        <label for="n">Водяные знаки</label>
                        <input type="text" name="water_ex" value="<?= $exp['water_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Совмещающиеся изображения</label>
                        <input type="text" name="sovmimg_ex" value="<?= $exp['sovmimg_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Метки для людей с ослабленным зрением</label>
                        <input type="text" name="met_ex" value="<?= $exp['met_ex'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Оптически изменяющаяся краска</label>
                        <input type="text" name="opt_ex" value="<?= $exp['opt_ex'] ?>" required/>
                    </div>
                </div>
                <div class="facts_four_section">
                    <h2>Приложения</h2>
                    <input type="file" name="material_ex[]" multiple id="gallery-photo-add">
                    <div class="gallery" id="galer"></div>
                    <?php
                    $sql2 = "SELECT * FROM `material_expertise` WHERE num_mex = " .  $exp['pril_num_ex'];
                    $cep  = $mysqli->query($sql2);
                    if ($cep > 0) {
                        $cep = mysqli_fetch_all($cep);
                        foreach ($cep as $num) {
                            echo '
                            <div style="text-align: left; "><a style="text-decoration: none;" href="' . $num[2] . '">Ссылка на изображение</a></div>
                                                                   
                                    '; 
                        };
                    } else {
                        echo 'Материалы отсутсвуют!!!';
                    };
                    ?>
                </div>
            </div>
            <input type="submit" value="Отправить">
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
    <script src="/form_styler/jquery.formstyler.js"></script>
    <script src="/form_styler/styler.js"></script>
</body>

</html>