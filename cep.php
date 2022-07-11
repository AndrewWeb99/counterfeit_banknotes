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
        #pct_l,
        #pct_l1,
        #pct_l2 {
            display: none;
            width: 20%;
            height: 16em;
            /* background: silver; */
            background-size: contain; 
            background-repeat: no-repeat;
            /* background-position: center; */
        }

        #map {
            height: 400px;
            width: auto;
        }

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

        <form action="/vendor/cep.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Добавление цепочки возникновения подделки</h1>

            <div class="facts_four_section">
                <h2>Цепочка возникновения подделки</h2>
                <!-- <a href="/cep.php">Добавить</a> -->

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
                            <th>Действие</th>
                            <th>Удаление</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $max_id = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
                        $nummain = mysqli_fetch_all($max_id);
                        foreach ($nummain as $nus) {
                            $max_id = $nus[0];
                        };
                        $cep = $mysqli->query("SELECT * FROM `chain` WHERE numb_ch = '$max_id'");
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
                            <td><a class="button_table" href="/blocks/update_reestr_cep.php?number=' . $num[0] . '">Изменить</a></td>
                            <td><a class="button_table" href="/blocks/vendor/v_del_reestr_cep.php?number=' . $num[0] . '">Удалить</a></td>
                        </tr>
                            
                            
                            ';
                        };
                        ?>

                    </tbody>
                </table>

            </div>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Сведения о том, кто передал подделку</h2>
                    <div class="field">
                        <label for="ln">В отношении</label>
                        <select name="ust_ch" required>
                            <option value="Установленное лицо" selected>Установленное лицо</option>
                            <option value="Неустановленное лицо">Неустановленное лицо</option>

                        </select>
                    </div>
                    <div class="field">
                        <label for="n">ИИН</label>
                        <input type="text" name="iin_ch" class="iin_pa" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Фамилия</label>
                        <input type="text" name="fam_ch" required/>
                    </div>
                    <div class="field">
                        <label for="a">Имя</label>
                        <input type="text" name="name_ch" required/>
                    </div>
                    <div class="field">
                        <label for="n">Отчество</label>
                        <input type="text" name="otch_ch" required/>
                    </div>
                    <div class="field">
                        <label for="n">Место работы</label>
                        <input type="text" name="place_ch" required/>
                    </div>
                    <div class="field">
                        <label for="n">Должность</label>
                        <input type="text" name="work_ch" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Роль</label>
                        <select name="role_ch" required>
                            <option value="Обвиняемый" selected>Обвиняемый</option>
                            <option value="Свидетель">Свидетель</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="a">Дата события</label>
                        <input type="date" name="date_ch" required/>
                    </div>
                    <div class="field">
                        <label for="">Анфас</label>
                        <input type="file" name="anfas_ch" id="pct" required/>
                        <p for="" id="pct_l"></p>
                    </div>
                    <div class="field">
                        <label for="">Профиль</label>
                        <input type="file" name="prof_ch" id="pct1" required/>
                        <p for="" id="pct_l1"></p>
                    </div>
                    <div class="field">
                        <label for="">Дактокарта</label>
                        <input type="file" name="dakt_ch" id="pct2" required/>
                        <p for="" id="pct_l2"></p>
                    </div>
                </div>

                <div class="facts_one_section_ver">
                    <h2 style="margin-left: 0;">Сведения о месте передачи</h2>
                    <div class="field">
                        <label for="n">Тип места</label>
                        <input type="text" name="mest_ch" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Наименование объекта</label>
                        <input type="text" name="name_mest_ch" required/>
                    </div>
                    <div class="field">
                        <label for="a">Населенный пункт</label>
                        <input type="text" name="nsp_ch" id="rn" required/>
                    </div>
                    <div class="field">
                        <label for="a">Улица</label>
                        <input type="text" name="street_ch" id="street" required/>
                    </div>
                    <div class="field">
                        <label for="a">Дом</label>
                        <input type="text" name="home_ch" id="house" required/>
                    </div>
                    <div class="field">
                        <label for="a">Долгота</label>
                        <input type="text" name="dolg_ch" id="dolg" required/>
                    </div>
                    <div class="field">
                        <label for="a">Широта</label>
                        <input type="text" name="shir_ch" id="shir" required/>
                    </div>
                    <br><br>
                    <div id="map"></div> 
                </div>
                <div class="facts_two_section">
                    <h2>Материалы с места обнаружения</h2>
                    <input type="file" name="material_ch[]" multiple id="gallery-photo-add" required>
                    <div class="gallery" id="galer"></div>
                </div>
                <div class="facts_two_section">
                    <h2>Комментарий</h2>
                    <textarea name="comment_ch" id="" cols="30" rows="10" required></textarea>
                </div>
            </div>
            <input type="submit" value="Отправить" style="margin-top: 10px; margin-bottom: 10px; margin-right: 5px;"><a class="button_table" href="/banknote.php" style="padding: 12px; margin-top: 10px; margin-bottom: 10px;">Далее</a>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaCEckEfWrmRurAosjxEF4HMvuEijUgDE&callback=initMap&v=weekly" defer></script>
    <script src="/js/map.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/table.js"></script>
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