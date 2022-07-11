let role_pa1 = document.getElementById("role_pa1");
let role_pa2 = document.getElementById("role_pa2");
let role_pa3 = document.getElementById("role_pa3");
let dop_role = document.getElementById("dop_role");

let obst_re1 = document.getElementById("obst_re1");
let obst_re2 = document.getElementById("obst_re2");
let obst_re3 = document.getElementById("obst_re3");
let obst_re4 = document.getElementById("obst_re4");
let obst_re5 = document.getElementById("obst_re5");
let obst_re6 = document.getElementById("obst_re6");
let dop_obst = document.getElementById("dop_obst");

document.addEventListener("DOMContentLoaded", function () {
  if (dop_role.value == "Работник органов") {
    role_pa1.setAttribute("selected", "selected");
  } else if (dop_role.value == "Свидетель") {
    role_pa2.setAttribute("selected", "selected");
  } else if (dop_role.value == "Работник банка") {
    role_pa3.setAttribute("selected", "selected");
  }

  if (dop_obst.value == "В ходе ОРМ") {
    obst_re1.setAttribute("selected", "selected");
  } else if (dop_obst.value == "От органов УВД") {
    obst_re2.setAttribute("selected", "selected");
  } else if (dop_obst.value == "От физ. лиц") {
    obst_re3.setAttribute("selected", "selected");
  } else if (dop_obst.value == "От юр. лиц") {
    obst_re4.setAttribute("selected", "selected");
  } else if (dop_obst.value == "По сообщению банка") {
    obst_re5.setAttribute("selected", "selected");
  } else if (dop_obst.value == "Разовый сбыт") {
    obst_re6.setAttribute("selected", "selected");
  }
});
