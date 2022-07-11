<?php
session_start();
require_once '../../vendor/settings.php';

if (isset($_GET['num'])) {
    $num = $_GET['num'];
    $sql1 = "SELECT * FROM `expertise` WHERE id_ex = $num";
    $exp  = $mysqli->query($sql1);
    $exp = mysqli_fetch_assoc($exp);
    $sql1 = "DELETE FROM `material_expertise` WHERE `material_expertise`.`num_mex` = " . $exp['pril_num_ex'];

    //Запись в журнал
    $d_user = $_SESSION["user"]["name"] . ', ' .  $_SESSION["user"]["role"];
    $max_jr = $mysqli->query("SELECT `num_ex` FROM `expertise` WHERE `id_ex` = $num");
    $max = mysqli_fetch_all($max_jr);
    foreach ($max as $nus) {
        $max1 = $nus[0];
    }
    $date_jr = date('Y/m/d H:i:s');
    $mysqli->query("INSERT INTO `journal` (`id_jr`, `fio_jr`, `dest_jr`, `fact_jr`, `section_jr`, `id_zap_jr`, `date`) VALUES (NULL, '$d_user', 'Удаление', '$max1', 'Экспертиза', '$num', '$date_jr');");

    $mat = $mysqli->query($sql1);
    $sql1 = "DELETE FROM `expertise` WHERE `expertise`.`id_ex` = $num";
    $ch = $mysqli->query($sql1);
    
}
header('Location: /reestr_banknote.php');