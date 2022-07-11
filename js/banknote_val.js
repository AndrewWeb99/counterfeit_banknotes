let type_ba = document.getElementById("type_ba");
let suven_ba = document.getElementById("suven_ba");

let combo_ba = document.getElementById("combo_ba");
let ser_one_ba = document.getElementById("ser_one_ba");
let ser_two_ba = document.getElementById("ser_two_ba");
let number_one_ba = document.getElementById("number_one_ba");
let number_two_ba = document.getElementById("number_two_ba");

let val_ba = document.getElementById("val_ba");

let nominal_ba = document.getElementById("nominal_ba");

type_ba.addEventListener("change", function () {
  if (type_ba.value == "Банкнота") { 
    suven_ba.setAttribute("readOnly", "readOnly");
    suven_ba.style.pointerEvents = "none";
  } else {
    suven_ba.removeAttribute("readOnly", "readOnly");
    suven_ba.style.pointerEvents = "auto";
  }

  if (type_ba.value == "Монета") {
    combo_ba.setAttribute("readOnly", "readOnly"); 
    combo_ba.style.pointerEvents = "none";
    ser_one_ba.setAttribute("readOnly", "readOnly");
    ser_two_ba.setAttribute("readOnly", "readOnly");
    number_one_ba.setAttribute("readOnly", "readOnly");
    number_two_ba.setAttribute("readOnly", "readOnly");
  } else {
    combo_ba.removeAttribute("readOnly", "readOnly");
    combo_ba.style.pointerEvents = "auto";
    ser_one_ba.removeAttribute("readOnly", "readOnly");
    ser_two_ba.removeAttribute("readOnly", "readOnly");
    number_one_ba.removeAttribute("readOnly", "readOnly");
    number_two_ba.removeAttribute("readOnly", "readOnly");
  }
});
//Дополнить для монет
val_ba.addEventListener("change", function () {
  if (val_ba.value == "Тенге") {
    ser_one_ba.maxLength = "2";
    ser_two_ba.maxLength = "2";
    nominal_ba.innerHTML = "";
    number_one_ba.maxLength = "7";
    number_two_ba.maxLength = "7";
    nominal_ba.insertAdjacentHTML(
      "afterbegin",
      '<option id="nominal_opt" value="200" selected>200</option> <option id="nominal_opt" value="500">500</option> <option id="nominal_opt" value="1000">1000</option> <option id="nominal_opt" value="2000">2000</option> <option id="nominal_opt" value="5000">5000</option> <option id="nominal_opt" value="10000">10000</option> <option id="nominal_opt" value="20000">20000</option>'
    );
  } else if (val_ba.value == "Рубль") {
    ser_one_ba.maxLength = "2";
    ser_two_ba.maxLength = "2";
    nominal_ba.innerHTML = "";
    number_one_ba.maxLength = "7";
    number_two_ba.maxLength = "7";
    nominal_ba.insertAdjacentHTML(
      "afterbegin",
      '<option id="nominal_opt" value="5" selected>5</option> <option id="nominal_opt" value="10">10</option> <option id="nominal_opt" value="50">50</option> <option id="nominal_opt" value="100">100</option> <option id="nominal_opt" value="500">500</option> <option id="nominal_opt" value="1000">1000</option> <option id="nominal_opt" value="5000">5000</option>'
    );
  } else if (val_ba.value == "Евро") {
    ser_one_ba.maxLength = "1";
    ser_two_ba.maxLength = "1";
    nominal_ba.innerHTML = "";
    number_one_ba.maxLength = "11";
    number_two_ba.maxLength = "11";
    nominal_ba.insertAdjacentHTML(
      "afterbegin",
      '<option id="nominal_opt" value="5" selected>5</option> <option id="nominal_opt" value="10">10</option> <option id="nominal_opt" value="20">20</option> <option id="nominal_opt" value="50">50</option> <option id="nominal_opt" value="100">100</option> <option id="nominal_opt" value="200">200</option> <option id="nominal_opt" value="500">500</option>'
    );
  } else if (val_ba.value == "Доллар") {
    ser_one_ba.maxLength = "1";
    ser_two_ba.maxLength = "1";
    nominal_ba.innerHTML = "";
    number_one_ba.maxLength = "11";
    number_two_ba.maxLength = "11";
    nominal_ba.insertAdjacentHTML(
      "afterbegin",
      '<option id="nominal_opt" value="1" selected>1</option> <option id="nominal_opt" value="2">2</option> <option id="nominal_opt" value="5">5</option> <option id="nominal_opt" value="10">10</option> <option id="nominal_opt" value="20">20</option> <option id="nominal_opt" value="50">50</option> <option id="nominal_opt" value="100">100</option>'
    );
  } else {
    nominal_ba.innerHTML = "";
    nominal_ba.insertAdjacentHTML(
      "afterbegin",
      '<option id="nominal_opt" value="200" selected>200</option> <option id="nominal_opt" value="500">500</option> <option id="nominal_opt" value="1000">1000</option> <option id="nominal_opt" value="2000">2000</option> <option id="nominal_opt" value="5000">5000</option> <option id="nominal_opt" value="10000">10000</option> <option id="nominal_opt" value="20000">20000</option>'
    );
  }
});

combo_ba.addEventListener("change", function () {
  if (combo_ba.value == "Обычная" || combo_ba.value == "Подлинная") {
    ser_two_ba.disabled = true;
    number_two_ba.disabled = true;
  } else {
    ser_two_ba.disabled = false;
    number_two_ba.disabled = false;
  }
});

// div.insertAdjacentHTML('beforebegin', '<p>Привет</p>');
// div.insertAdjacentHTML('afterend', '<p>Пока</p>');
