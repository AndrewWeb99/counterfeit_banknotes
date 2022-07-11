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
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
    <title>Реестр фактов обнаружения</title>
</head>

<body>
    <!-- заголовок -->
    <?php require('header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('nav.php'); ?>

        <form action="/vendor/cep.php" method="post" enctype="multipart/form-data">
            <h1 class="title_main">Просмотр цепочки возникновения подделки </h1>
            <div class="facts_sections">
                <div class="facts_two_section">
                    <h2>Сведения о том, кто передал подделку</h2>
                    <div class="field">
                        <label for="ln">В отношении</label>
                        <input id="dop_ust" type="text" name="" value="<?= $chain['ust_ch'] ?>" hidden />
                        <select name="ust_ch" id="ust_ch" disabled>
                            <option id="ust_ch1" value="Установленное лицо">Установленное лицо</option>
                            <option id="ust_ch2" value="Неустановленное лицо" selected>Неустановленное лицо</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="n">ИИН</label>
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
                        <input id="dop_role" type="text" name="" value="<?= $chain['role_ch'] ?>" hidden /> 
                        <select name="role_ch" disabled>
                            <option id="role_ch1" value="Обвиняемый">Обвиняемый</option>
                            <option id="role_ch2" value="Свидетель" selected>Свидетель</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="a">Дата события</label>
                        <input type="date" name="date_ch" value="<?= $chain['date_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Анфас</label>
                        <input type="file" name="anfas_ch" hidden />
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['anfas_ch'] ?>">Ссылка на изображение</a></div>
                    </div>
                    <div class="field">
                        <label for="a">Профиль</label>
                        <input type="file" name="prof_ch" hidden />
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['prof_ch'] ?>">Ссылка на изображение</a></div>
                    </div>
                    <div class="field">
                        <label for="a">Дактокарта</label>
                        <input type="file" name="dakt_ch" hidden />
                        <div style="width:60%;"><a style="margin-right: 0px; text-decoration:none;" href="<?= $chain['dakt_ch'] ?>">Ссылка на изображение</a></div>
                    </div>
                </div>

                <div class="facts_one_section_ver">
                    <h2 style="margin-left: 0;">Сведения о месте передачи</h2>
                    <div class="field">
                        <label for="n">Тип места</label>
                        <input type="text" name="mest_ch" value="<?= $chain['mest_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="ln">Наименование объекта</label>
                        <input type="text" name="name_mest_ch" value="<?= $chain['name_mest_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Населенный пункт</label>
                        <input type="text" name="nsp_ch" value="<?= $chain['nsp_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Улица</label>
                        <input type="text" name="street_ch" value="<?= $chain['street_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Дом</label>
                        <input type="text" name="home_ch" value="<?= $chain['home_ch'] ?>" readonly/>
                    </div>
                    <div class="field">
                        <label for="a">Долгота</label>
                        <input type="text" name="dolg_ch" value="<?= $chain['dolg_ch'] ?>" readonly/> 
                    </div>
                    <div class="field">
                        <label for="a">Широта</label>
                        <input type="text" name="shir_ch" value="<?= $chain['shir_ch'] ?>" readonly/>
                    </div>
                    <br><br>

                </div>
                <div class="facts_two_section">
                    <h2>Материалы с места обнаружения</h2>
                    <input type="file" name="material_ch[]" multiple hidden>
                    <?php
                    $sql2 = "SELECT * FROM `material_chain` WHERE numb_mch = " . $chain['material_ch'];
                    $cep  = $mysqli->query($sql2);
                    if (mysqli_num_rows($cep) > 0) {
                        $cep = mysqli_fetch_all($cep);
                        foreach ($cep as $num) {
                            echo '
                            <div style=""><a style="text-decoration:none;" href="' . $num[2] . '">Ссылка на изображение</a></div>
                                                                   
                                    ';
                        };
                    } else {
                        echo 'Проверьте введенные данные!!!';
                    };
                    ?>
                </div>
                <div class="facts_two_section">
                    <h2>Комментарий</h2>
                    <textarea name="comment_ch" id="" cols="30" rows="10" readonly><?= $chain['comment_ch'] ?></textarea>
                </div>
            </div>
            
        </form>



    </div>
    <script type="text/javascript" src="/js/open_reestr_cep.js"></script>
</body>

</html>