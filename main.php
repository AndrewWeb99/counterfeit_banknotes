<?php
session_start();
if (isset($_SESSION["auth"]) && $_SESSION["auth"] !== true) {
    header('Location: /login.php');
}
require_once 'vendor/settings.php';


$ch1 = $mysqli->query("SELECT * FROM `banknote`");
$ch1 = mysqli_fetch_all($ch1);
$tenge = 0;
$rub = 0;
$dol = 0;
$eu = 0;
$dr = 0;
foreach ($ch1 as $num) {
    if ($num[3] == 'Тенге') {
        $tenge++;
    }
    if ($num[3] == 'Рубль') {
        $rub++;
    }
    if ($num[3] == 'Доллар') {
        $dol++;
    }
    if ($num[3] == 'Евро') {
        $eu++;
    }
    if ($num[3] == 'Другое') {
        $dr++;
    }
};

$ch2 = $mysqli->query("SELECT MONTH(date_re) FROM `regist`");
$ch2 = mysqli_fetch_all($ch2);
$m1 = 0;
$m2 = 0;
$m3 = 0;
$m4 = 0;
$m5 = 0;
$m6 = 0;
$m7 = 0;
$m8 = 0;
$m9 = 0;
$m10 = 0;
$m11 = 0;
$m12 = 0;
foreach ($ch2 as $num) {
    if ($num[0] == '1') {
        $m1++;
    }
    if ($num[0] == '2') {
        $m2++;
    }
    if ($num[0] == '3') {
        $m3++;
    }
    if ($num[0] == '4') {
        $m4++;
    }
    if ($num[0] == 5) {
        $m5++;
    }
    if ($num[0] == 6) {
        $m6++;
    }
    if ($num[0] == 7) {
        $m7++;
    }
    if ($num[0] == 8) {
        $m8++;
    }
    if ($num[0] == 9) {
        $m9++;
    }
    if ($num[0] == 10) {
        $m10++;
    }
    if ($num[0] == 11) {
        $m11++;
    }
    if ($num[0] == 12) {
        $m12++;
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="icon" href="/images/photo_2022-04-17_15-10-29.ico" />
      <title>Главное окно</title>
</head>

<body>
    <!-- заголовок -->
    <?php require('./blocks/header.php'); ?>
    <!-- основа -->
    <div class="container">
        <?php require('./blocks/nav.php'); ?>
        <div class="main">
            <div class="charts_one">
                <div class="chartOne">
                    <h2>Статистика самых подделываемых банкнот</h2>
                    <canvas id="myChart"></canvas>
                </div>
                <div class="chartTwo">
                    <h2>Записи за 2022 год</h2>
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
            <div class="info">
                <div class="fact">
                    <h3>Информация по фактам обнаружения</h3>
                    <a class="main_link"  href="/reestr_facts.php">Открыть реестр</a>
                </div>
                <div class="bank">
                    <h3>Информация по банкнотам</h3>
                    <a class="main_link"  href="/reestr_banknote.php">Открыть реестр</a>
                </div>
                <div class="uch">
                    <h3>Информация по участникам</h3>
                    <a class="main_link"  href="/reestr_uch.php">Открыть реестр</a>
                </div>
            </div>

        </div>
    </div>
    <script src="/js/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Тенге', 'Рубль', 'Евро', 'Доллар', 'Другое'],
                datasets: [{
                    label: 'Количество инцидентов',
                    data: [<?= $tenge ?>, <?= $rub ?>, <?= $eu ?>, <?= $dol ?>, <?= $dr ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            // options: {
            //     scales: {
            //         y: {
            //             beginAtZero: true
            //         }
            //     }
            // }
        });
    </script>
    <script>
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        const myChart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                datasets: [{
                    label: 'Инцидентов за месяц',
                    data: [<?= $m1 ?>, <?= $m2 ?>, <?= $m3 ?>, <?= $m4 ?>, <?= $m5 ?>, <?= $m6 ?>, <?= $m7 ?>, <?= $m8 ?>, <?= $m9 ?>, <?= $m10 ?>, <?= $m11 ?>, <?= $m12 ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            // options: {
            //     scales: {
            //         y: {
            //             beginAtZero: true
            //         }
            //     }
            // }
        });
    </script>
</body>

</html>