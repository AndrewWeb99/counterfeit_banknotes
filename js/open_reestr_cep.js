let ust_ch1 = document.getElementById("ust_ch1");
let ust_ch2 = document.getElementById("ust_ch2");
let dop_ust = document.getElementById("dop_ust");

let role_ch1 = document.getElementById("role_ch1");
let role_ch2 = document.getElementById("role_ch2");
let dop_role = document.getElementById("dop_role");

document.addEventListener("DOMContentLoaded", function () {
  if (dop_ust.value == "Установленное лицо") {
    ust_ch1.setAttribute("selected", "selected");
  } else if (dop_ust.value == "Неустановленное лицо") {
    ust_ch2.setAttribute("selected", "selected");
  }

  if (dop_role.value == "Обвиняемый") {
    role_ch1.setAttribute("selected", "selected");
  } else if (dop_ust.value == "Свидетель") {
    role_ch2.setAttribute("selected", "selected");
  }
});
