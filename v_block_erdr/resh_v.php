<?php
session_start();
require_once '../vendor/settings.php';

//Связь
$max_idmain = $mysqli->query("SELECT MAX(`numb_dop`) FROM `dop_table`");
$nummain = mysqli_fetch_all($max_idmain);
foreach ($nummain as $nus) {
    $max_id_dop = $nus[0];
};

// Данные подделки
$rez_re = $_POST['rez_re'];
$kval_re = $_POST['kval_re'];
$stat_re = $_POST['stat_re'];
$date_re = $_POST['date_re'];
$perkval_re = $_POST['perkval_re'];
$num_pr_re = $_POST['num_pr_re'];
$date_vud_re = $_POST['date_vud_re'];
$resh_re = $_POST['resh_re'];
$fab_re = $_POST['fab_re'];


//Множественная загрузка
$uploaddir = '../images/uploads_exp/';
if (isset($_FILES['material_re']['name'])) {

    $total_files = count($_FILES['material_re']['name']);

    for ($key = 0; $key < $total_files; $key++) {

        // Check if file is selected
        if (
            isset($_FILES['material_re']['name'][$key])
            && $_FILES['material_re']['size'][$key] > 0
        ) {

            $filename = $_FILES['material_re']['name'][$key];
            $ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);
      
            $target = $uploaddir.uniqid('file_').$ext;

            $tmp  = $_FILES['material_re']['tmp_name'][$key];
            move_uploaded_file($tmp, $target);
            $mysqli->query("INSERT INTO `material_resh` (`id_mr`, `numb_mr`, `path_mr`) VALUES (NULL, '$max_id_dop', '$target')");
        }
    }
}
// $mysqli->query("");

if ($rez_re == 'Уголовное дело на стадии расследования' or $rez_re == 'Возбуждено УД' or $rez_re == 'Направлено в суд') {
    $mysqli->query("INSERT INTO `resh` (`id_re`, `num_fact_re`, `rez_re`, `kval_re`, `stat_re`, `date_re`, `perkval_re`, `num_pr_re`, `date_vud_re`, `resh_re`, `fab_re`, `material_num_re`) VALUES (NULL, '$max_id_dop', '$rez_re', NULL, NULL, '$date_re', NULL, NULL, NULL, NULL, '$fab_re', '$max_id_dop')");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `resh`");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Принятое по делу решение', '$max1', '$date_jr');");
}
if ($rez_re == 'Переквалифицировано') {
    $mysqli->query("INSERT INTO `resh` (`id_re`, `num_fact_re`, `rez_re`, `kval_re`, `stat_re`, `date_re`, `perkval_re`, `num_pr_re`, `date_vud_re`, `resh_re`, `fab_re`, `material_num_re`) VALUES (NULL, '$max_id_dop', '$rez_re', '$kval_re', NULL, '$date_re', '$perkval_re', NULL, NULL, NULL, '$fab_re', '$max_id_dop')");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `resh`");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Принятое по делу решение', '$max1', '$date_jr');");
}
if ($rez_re == 'Присоединено к УД') {
    $mysqli->query("INSERT INTO `resh` (`id_re`, `num_fact_re`, `rez_re`, `kval_re`, `stat_re`, `date_re`, `perkval_re`, `num_pr_re`, `date_vud_re`, `resh_re`, `fab_re`, `material_num_re`) VALUES (NULL, '$max_id_dop', '$rez_re', NULL, NULL, '$date_re', NULL, '$num_pr_re', '$date_vud_re', NULL, '$fab_re', '$max_id_dop')");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `resh`");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Принятое по делу решение', '$max1', '$date_jr');");
}
if ($rez_re == 'Уголовное дело приостановлено' or $rez_re == 'Уrоловное дело возобновлено' or $rez_re == 'Уголовное дело прекращено') {
    $mysqli->query("INSERT INTO `resh` (`id_re`, `num_fact_re`, `rez_re`, `kval_re`, `stat_re`, `date_re`, `perkval_re`, `num_pr_re`, `date_vud_re`, `resh_re`, `fab_re`, `material_num_re`) VALUES (NULL, '$max_id_dop', '$rez_re', NULL, '$stat_re', '$date_re', NULL, NULL, NULL, NULL, '$fab_re', '$max_id_dop')");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `resh`");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Принятое по делу решение', '$max1', '$date_jr');");
}
if ($rez_re == 'Решение суда') {
    $mysqli->query("INSERT INTO `resh` (`id_re`, `num_fact_re`, `rez_re`, `kval_re`, `stat_re`, `date_re`, `perkval_re`, `num_pr_re`, `date_vud_re`, `resh_re`, `fab_re`, `material_num_re`) VALUES (NULL, '$max_id_dop', '$rez_re', NULL, NULL, '$date_re', NULL, NULL, NULL, '$resh_re', '$fab_re', '$max_id_dop')");
    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT MAX(`id_re`) FROM `resh`");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Добавление', '$max_id_dop', 'Принятое по делу решение', '$max1', '$date_jr');");
}






header('Location: /erdr.php');
