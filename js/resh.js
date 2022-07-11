let null_zn = document.getElementById("null_zn");
//Резолюция
let rez_re = document.getElementById("rez_re");
//Дата принятия решения
let date_re = document.getElementById("date_re");
//Квалификация УК РК
let kval_re = document.getElementById("kval_re");
//Статья УПК РК
let stat_re = document.getElementById("stat_re");
//Переквалификация
let perkval_re = document.getElementById("perkval_re");
//№ УД (присоединения)
let num_pr_re = document.getElementById("num_pr_re");
//Дата ВУД (присоединения)
let date_vud_re = document.getElementById("date_vud_re");
//Решение суда
let resh_re = document.getElementById("resh_re");

rez_re.addEventListener("change", function () {
  null_zn.remove();
  date_re.disabled = false;
  kval_re.disabled = false;
  stat_re.disabled = false;
  perkval_re.disabled = false;
  num_pr_re.disabled = false;
  date_vud_re.disabled = false;
  resh_re.disabled = false;
  if (
    rez_re.value == "Возбуждено УД" ||
    rez_re.value == "Уголовное дело на стадии расследования"
  ) {
    //----------------------------------
    kval_re.disabled = true;
    stat_re.disabled = true;
    perkval_re.disabled = true;
    num_pr_re.disabled = true;
    date_vud_re.disabled = true;
    resh_re.disabled = true;
  } else if (rez_re.value == "Переквалифицировано") {
    stat_re.disabled = true;
    num_pr_re.disabled = true;
    date_vud_re.disabled = true;
    resh_re.disabled = true;
  } else if (rez_re.value == "Присоединено к УД") {
    stat_re.disabled = true;
    kval_re.disabled = true;
    perkval_re.disabled = true;
    resh_re.disabled = true;
  } else if (
    rez_re.value == "Уголовное дело приостановлено" ||
    rez_re.value == "Уrоловное дело возобновлено" ||
    rez_re.value == "Уголовное дело прекращено"
  ) {
    kval_re.disabled = true;
    perkval_re.disabled = true;
    num_pr_re.disabled = true;
    date_vud_re.disabled = true;
    resh_re.disabled = true;
  } else if (rez_re.value == "Направлено в суд") {
    kval_re.disabled = true;
    stat_re.disabled = true;
    perkval_re.disabled = true;
    num_pr_re.disabled = true;
    date_vud_re.disabled = true;
    resh_re.disabled = true;
  } else if (rez_re.value == "Решение суда") {
    kval_re.disabled = true;
    stat_re.disabled = true;
    perkval_re.disabled = true;
    num_pr_re.disabled = true;
    date_vud_re.disabled = true;
  }
});
