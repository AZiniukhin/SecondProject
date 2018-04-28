var lat;
var lng;

function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 10
        });

        var infoWindow = new google.maps.InfoWindow({map: map});

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                map.setCenter(pos);
                console.log(pos);

            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function (position) {
            lat = position.coords.latitude;
            lng = position.coords.longitude;

            $.ajax({
                url: '/',
                type: 'POST',
                dataType: 'json',
                data: {'lat': lat,  'lng': lng, '_token': tok},


                success: function(data) {
                    console.log(data.saved);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }, function () {

        }, {
            enableHighAccuracy: true,
            maximumAge: 4000
        });

    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}


//
// var map;
//
// var myLatLng;
//
// var lat;
//
// var lng;
//
// $(document).ready(function () {
//
//     geoLocationInit();
//
//     function geoLocationInit() {
//         if (navigator.geolocation) {
//             navigator.geolocation.watchPosition(success, fail);
//         } else {
//             console.log("Browser not supported");
//             map = new google.maps.Map(document.getElementById('map'), {
//                 center: {lat: 49.9830761, lng: 36.2345538},
//                 zoom: 12
//             });
//         }
//     }
//
//     function success(position) {
//         console.log('Ваше местоположение найдено');
//
//         lat = position.coords.latitude;
//         lng = position.coords.longitude;
//
//         var latval = position.coords.latitude;
//         var lngval = position.coords.longitude;
//
//         myLatLng = new google.maps.LatLng(latval, lngval);
//
//         console.log([latval, lngval]);
//
//         createMap(myLatLng);
//
//         function createMap(myLatLng) {
//
//             map = new google.maps.Map(document.getElementById('map'), {
//
//                 center: myLatLng,
//
//                 zoom: 12
//
//             });
//
//             var marker = new google.maps.Marker({
//                 position: myLatLng,
//                 map: map
//             });
//         }
//
//
//     }
//     function fail(positionError) {
//         console.log('Нету вашего местоположения');
//         console.log(positionError);
//
//         map = new google.maps.Map(document.getElementById('map'), {
//             center: {lat: 49.9830761, lng: 36.2345538},
//             zoom: 12
//         });
//     }
// });
//
//
//
// function getLocation() {
//
//             $.ajax({
//                 url: '/',
//                 type: 'POST',
//                 dataType: 'json',
//                 data: {'lat': lat,  'lng': lng, '_token': tok},
//
//
//                 success: function(data) {
//                     //console.log('Hello');
//                     console.log(data.saved);
// //                            $('#res1').html(lat + ' ' + lng);
// //                            $('#res2').html(lat);
//
//                 },
//                 error: function(e) {
//                     console.log(1);
//                 }
//
//             });
// //                })
//
//
//
// }