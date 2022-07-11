var markers = [];
let rn = document.getElementById("rn");
let street = document.getElementById("street");
let house = document.getElementById("house");
let dolg = document.getElementById("dolg");
let shir = document.getElementById("shir");




function initMap() {
  var pos = { lat: 54.87027324098806, lng: 69.1440942723177 };
  var opt = {
    center: pos,
    zoom: 12,
  };
  var map = new google.maps.Map(document.getElementById("map"), opt);
  //Стартовый маркер
  const marker = new google.maps.Marker({
    position: opt.center,
    map: map,
  });
  markers.push(marker);
  //Удаление маркера
  function removeMarkers() {
    for (i = 0; i < markers.length; i++) {
      markers[i].setMap(null);
    }
    markers = [];
  }
  
  //Добавление маркера
  google.maps.event.addListener(map, "click", function (event) {
    removeMarkers();
    // создание маркера
    const marker = new google.maps.Marker({
      position: event.latLng,
      map: map,
    });
    markers.push(marker);
    //Декодинг координат

    new google.maps.Geocoder().geocode(
      {
        latLng: new google.maps.LatLng(event.latLng),
      },
      function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          street.value = results[0].address_components[1].long_name;
          house.value = results[0].address_components[0].long_name;
          rn.value =
            results[0].address_components[5].long_name +
            ", " +
            results[0].address_components[4].long_name +
            ", " +
            results[0].address_components[3].long_name +
            ", " +
            results[0].address_components[2].long_name;
          shir.value = event.latLng.lat();
          dolg.value = event.latLng.lng();
        }
      }
    );

    // создание окна
    var info = new google.maps.InfoWindow({
      content: "",
    });
    marker.addListener("click", function () {
      info.open(info, marker);
    });
    console.log(marker);
  });
}
