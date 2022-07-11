<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}

require_once '../vendor/settings.php';
if (isset($_GET['number'])) {
    $number = $_GET['number'];
    $sql1 = "SELECT * FROM `chain` WHERE id_ch = $number";
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
            /* border: 1px solid black; */
            background-size: contain;
            background-repeat: no-repeat;
           
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
    <?php require('header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>
        
        <form action="/blocks/vendor/v_update_reestr_cep.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Изменение цепочки возникновения подделки </h1>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Сведения о том, кто передал подделку</h2>
                    <div class="field" style="display: none;">
                            <label for="n">Ссылка</label>
                            <input type="text" name="ref" value="<?= $number?>" readonly />
                        </div>
                    <div class="field" style="display: none;">
                        <label for="n">ID</label>
                        <input type="text" name="id_ch" value="<?= $chain['id_ch'] ?>" />
                    </div>
                    <div class="field" style="display: none;">
                        <label for="n">ID0</label>
                        <input type="text" name="material_ch" value="<?= $chain['material_ch'] ?>" />
                    </div>
                    <div class="field">
                        <label for="ln">В отношении</label>
                        <input id="dop_ust" type="text" name="" value="<?= $chain['ust_ch'] ?>" hidden />
                        <select name="ust_ch" id="ust_ch" required>
                            <option id="ust_ch1" value="Установленное лицо">Установленное лицо</option>
                            <option id="ust_ch2" value="Неустановленное лицо" selected>Неустановленное лицо</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="n">ИИН</label>
                        <input type="text" name="iin_ch" class="iin_pa" value="<?= $chain['iin_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Фамилия</label>
                        <input type="text" name="fam_ch" value="<?= $chain['fam_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="a">Имя</label>
                        <input type="text" name="name_ch" value="<?= $chain['name_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Отчество</label>
                        <input type="text" name="otch_ch" value="<?= $chain['otch_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Место работы</label>
                        <input type="text" name="place_ch" value="<?= $chain['place_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="n">Должность</label>
                        <input type="text" name="work_ch" value="<?= $chain['work_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Роль</label>
                        <input id="dop_role" type="text" name="" value="<?= $chain['role_ch'] ?>" hidden /> 
                        <select name="role_ch" required>
                            <option id="role_ch1" value="Обвиняемый">Обвиняемый</option>
                            <option id="role_ch2" value="Свидетель" selected>Свидетель</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="a">Дата события</label>
                        <input type="date" name="date_ch" value="<?= $chain['date_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="a">Анфас</label>
                        <input type="file" name="anfas_ch" id="pct"/>
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['anfas_ch'] ?>">Ссылка на изображение</a></div>
                        <p for="" id="pct_l"></p>
                    </div>
                    <div class="field">
                        <label for="a">Профиль</label>
                        <input type="file" name="prof_ch" id="pct1" />
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['prof_ch'] ?>">Ссылка на изображение</a></div>
                        <p for="" id="pct_l1"></p>
                    </div>
                    <div class="field">
                        <label for="a">Дактокарта</label>
                        <input type="file" name="dakt_ch" id="pct2"/>
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['dakt_ch'] ?>">Ссылка на изображение</a></div>
                        <p for="" id="pct_l2"></p>
                    </div>
                </div>

                <div class="facts_one_section_ver">
                    <h2 style="margin-left: 0;">Сведения о месте передачи</h2>
                    <div class="field">
                        <label for="n">Тип места</label>
                        <input type="text" name="mest_ch" value="<?= $chain['mest_ch'] ?>" required/>
                    </div>
                    <div class="field">
                        <label for="ln">Наименование объекта</label>
                        <input type="text" name="name_mest_ch" value="<?= $chain['name_mest_ch'] ?>" required />
                    </div>
                    <div class="field">
                        <label for="a">Населенный пункт</label>
                        <input type="text" name="nsp_ch" value="<?= $chain['nsp_ch'] ?>" id="rn" required/>
                    </div>
                    <div class="field">
                        <label for="a">Улица</label>
                        <input type="text" name="street_ch" value="<?= $chain['street_ch'] ?>" id="street" required/>
                    </div>
                    <div class="field">
                        <label for="a">Дом</label>
                        <input type="text" name="home_ch" value="<?= $chain['home_ch'] ?>" id="house" required/>
                    </div>
                    <div class="field">
                        <label for="a">Долгота</label>
                        <input type="text" name="dolg_ch" value="<?= $chain['dolg_ch'] ?>" id="dolg" required/>
                    </div>
                    <div class="field">
                        <label for="a">Широта</label>
                        <input type="text" name="shir_ch" value="<?= $chain['shir_ch'] ?>" id="shir" required/>
                    </div>
                    
                    
                    <br><br>
                    <div id="map"></div>
                </div>
                <div class="facts_two_section">
                    <h2>Материалы с места обнаружения</h2>
                    <input type="file" name="material_ch[]" multiple id="gallery-photo-add">
                    <div class="gallery" id="galer"></div>
                    <?php
                    $sql2 = "SELECT * FROM `material_chain` WHERE numb_mch = ". $chain['material_ch'];
                    $cep  = $mysqli->query($sql2);
                    if (isset($cep)) {
                        $cep = mysqli_fetch_all($cep);
                        foreach ($cep as $num) {
                            echo '
                            <div style=""><a style="text-decoration:none;" href="' . $num[2] . '">Ссылка на изображение</a></div>
                                                                   
                                    ';
                        };
                    } else {
                        echo 'Данные отсутсвуют!!!';
                    };
                    ?>
                </div> 
                <div class="facts_two_section">
                    <h2>Комментарий</h2>
                    <textarea name="comment_ch" id="" cols="30" rows="10" required><?= $chain['comment_ch'] ?></textarea>
                </div>
            </div>
            <input type="submit" value="Отправить"> 
        </form>



    </div>
    <script type="text/javascript" src="/js/open_reestr_cep.js"></script>
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
    <script>
        function checkingNumber(input) {
            input.value = input.value.replace(/[^\d]/g, '').substr(0, 10);
        };

        $('.iin_pa').on('keyup', function() {
            checkingNumber(this);
        });
    </script>
</body>

</html> 