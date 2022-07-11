let type_ba1 = document.getElementById("type_ba1");
let type_ba2 = document.getElementById("type_ba2");
let dop_type = document.getElementById("dop_type");

let val_ba1 = document.getElementById("val_ba1");
let val_ba2 = document.getElementById("val_ba2");
let val_ba3 = document.getElementById("val_ba3");
let val_ba4 = document.getElementById("val_ba4");
let val_ba5 = document.getElementById("val_ba5");
let dop_val = document.getElementById("dop_val");
 
let suven_ba1 = document.getElementById("suven_ba1");
let suven_ba2 = document.getElementById("suven_ba2");
let dop_suven = document.getElementById("dop_suven");

let combo_ba1 = document.getElementById("combo_ba1");
let combo_ba2 = document.getElementById("combo_ba2");
let combo_ba3 = document.getElementById("combo_ba3");
let dop_combo = document.getElementById("dop_combo");

let nominal_opt = document.querySelectorAll("#nominal_opt");
let dop_nominal = document.getElementById("dop_nominal");

document.addEventListener("DOMContentLoaded", function () {
  if (dop_type.value == "Банкнота") {
    type_ba1.setAttribute("selected", "selected");
  } else if (dop_type.value == "Монета") {
    type_ba2.setAttribute("selected", "selected");
  }

  if (dop_val.value == "Тенге") {
    val_ba1.setAttribute("selected", "selected");
  } else if (dop_val.value == "Рубль") {
    val_ba2.setAttribute("selected", "selected");
  } else if (dop_val.value == "Евро") {
    val_ba3.setAttribute("selected", "selected");
  } else if (dop_val.value == "Доллар") {
    val_ba4.setAttribute("selected", "selected");
  } else if (dop_val.value == "Другое") {
    val_ba5.setAttribute("selected", "selected");
  }

  if (dop_suven.value == "Да") {
    suven_ba1.setAttribute("selected", "selected");
  } else if (dop_suven.value == "Нет") {
    suven_ba2.setAttribute("selected", "selected");
  }

  if (dop_combo.value == "Обычная") {
    combo_ba1.setAttribute("selected", "selected");
  } else if (dop_combo.value == "Половинчатая") {
    combo_ba2.setAttribute("selected", "selected");
  } else if (dop_combo.value == "Подлинная") {
    combo_ba3.setAttribute("selected", "selected");
  }

  nominal_opt.forEach((element) => {
    if (element.value == dop_nominal.value) {
        element.setAttribute("selected", "selected");
    }
  });

});
