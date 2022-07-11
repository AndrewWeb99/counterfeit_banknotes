var markers = [];
function initMap() {
  var pos = { lat: 54.87027324098806, lng: 69.1440942723177 };
  var opt = {
    center: pos,
    zoom: 13,
  };
  var map = new google.maps.Map(document.getElementById("map"), opt);
  var posit;
  arrObjects.forEach((element) => {
    console.log(element.dolg);
    var posit = { lat: element.shir, lng: element.dolg };

    const marker = new google.maps.Marker({
      position: posit,
      map: map,
    });
    var info = new google.maps.InfoWindow({
      content:
        element.rn +
        ", " +
        element.street +
        ", " +
        element.house +
        ", квартира " +
        element.kv +
        ", " +
        '<a href="/blocks/open_reestr_facts.php?num=' +
        element.number +
        '">Номер факта: ' +
        element.number +
        "</a>",
    });
    marker.addListener("click", function () {
      info.open(info, marker);
    });
  });
}
