let role_pa1 = document.getElementById("role_pa1");
let role_pa2 = document.getElementById("role_pa2");
let role_pa3 = document.getElementById("role_pa3");
let dop_rol = document.getElementById("dop_rol");

document.addEventListener("DOMContentLoaded", function () {
  if (dop_rol.value == "Работник органов") {
    role_pa1.setAttribute("selected", "selected");
  } else if (dop_rol.value == "Свидетель") {
    role_pa2.setAttribute("selected", "selected");
  } else if (dop_rol.value == "Работник банка") {
    role_pa3.setAttribute("selected", "selected");
  }
});
