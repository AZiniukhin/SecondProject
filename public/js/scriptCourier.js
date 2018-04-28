
var myLatLng;
// var latit;
// var lngit;
// var latMap;
// var lngMap;
var map;
// var markerMy = null;
var markersClient = null;
var markersCourier = null;
// var resultsClient = null;
$(document).ready(function () {

    geoLocationInit();

    function geoLocationInit() {
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(success, fail);
        }else {
            console.log("Browser not supported");
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.9830761, lng: 36.2345538},
                zoom: 12
            });
        }
    }

    function success(position) {
        console.log('Ваше местоположение найдено');

        var latval = position.coords.latitude;
        var lngval = position.coords.longitude;

        myLatLng = new google.maps.LatLng(latval, lngval);

        console.log([latval, lngval]);

        createMap(myLatLng);


        function createMap(myLatLng) {

            map = new google.maps.Map(document.getElementById('map'), {

                center: myLatLng,

                zoom: 12

            });
        }
        var showLocation = setInterval(function searchFirst(latitude,longitude,first_name) {

            $.get('https://ok.findme.php.a-level.com.ua/searchFirst/'+tokenMap + '/' +id_map,{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {

                console.log(match);

                $.each(match, function (i, val) {

                    glatval = val.latitude;
                    glngval = val.longitude;
                    gname = val.first_name;
                    qdate = val.created_at;
                    GLatLng = new google.maps.LatLng(glatval,glngval);
                    createMarker(GLatLng,gname,qdate);

                });
            });

        },5000);

    }

    function fail(positionError) {
        console.log('Нету вашего местоположения');
        console.log(positionError);

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.9830761, lng: 36.2345538},
            zoom: 12
        });

        var showLocation = setInterval(function searchFirst(latitude,longitude,first_name) {

            $.get('https://ok.findme.php.a-level.com.ua/searchFirst/'+tokenMap + '/' +id_map ,{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {


                console.log(match);

                $.each(match, function (i, val) {
                    glatval = val.latitude;
                    glngval = val.longitude;
                    gname = val.first_name;
                    GLatLng = new google.maps.LatLng(glatval,glngval);
                    createMarker(GLatLng,gname);
                });
            });

        },10000);
    }
    // var infowindowsCourier = new google.maps.InfoWindow;
    // var infowindowsClient = new google.maps.InfoWindow;
    function createMarker(latlng,name,date) {
        if (name !== 'ClientMark') {

            function createMarkerCourier() {
                markersCourier = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: '/icon/delivery.png',
                    // animation: google.maps.Animation.BOUNCE,
                    title: name
                });

                infowindowsCourier = new google.maps.InfoWindow;
                infowindowsCourier.setContent('The label courier in ' + date);
                infowindowsCourier.open(map, markersCourier);
            }

            if (markersCourier !== null) {
                markersCourier.setMap(null);
                markersCourier = null;

                createMarkerCourier();
            } else {
                createMarkerCourier();
            }

        } else if (name == 'ClientMark') {
            function createMarkerClient() {
                markersClient = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    // icon: {
                    //     url: "/icon/delivery.png",
                    //     scaledSize: new google.maps.Size(64, 64)
                    // },
                    // animation: google.maps.Animation.BOUNCE,
                    title: name
                });

                infowindowsClient = new google.maps.InfoWindow;
                infowindowsClient.setContent('The label sent to the courier in ' + date);
                infowindowsClient.open(map, markersClient);
            }

            if (markersClient !== null) {
                markersClient.setMap(null);
                markersClient = null;

                createMarkerClient()
            } else {
                createMarkerClient()
            }
        }
    }
});

var markerCourier = window.location.href.split("/")[4];
var markerClient = window.location.href.split("/")[5];
var numberClient = window.location.href.split("/")[6];
console.log(markerCourier);
console.log(markerClient);
console.log(numberClient);

function checkMobileOS() {

    var MobileUserAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (MobileUserAgent.match(/iPad/i) || MobileUserAgent.match(/iPhone/i) || MobileUserAgent.match(/iPod/i)) {

        return 'iOS';

    } else if (MobileUserAgent.match(/Android/i)) {

        return 'Android';

    } else {

        return 'unknown';

    }

}

var message_text = 'https://ok.findme.php.a-level.com.ua/map/'+markerCourier+'/'+markerClient;

var href = '';

if (checkMobileOS() == 'iOS') {

    href = "sms:+38"+numberClient+"?body=" + encodeURI(message_text);

}

if (checkMobileOS() == 'Android') {

    href = "sms:+38"+numberClient+"?body=" + encodeURI(message_text);

}

document.getElementById("sms_link").setAttribute('href', href);


//===========================================================================================================================


// var map;
//
// var myLatLng;
//
// $(document).ready(function () {
//
//     geoLocationInit();
//
//     function geoLocationInit() {
//         if(navigator.geolocation){
//             navigator.geolocation.getCurrentPosition(success, fail);
//         }else {
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
//         var latval = position.coords.latitude;
//         var lngval = position.coords.longitude;
//
//         myLatLng = new google.maps.LatLng(latval,lngval);
//
//         console.log([latval,lngval]);
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
//         }
//
//         var showLocation = setInterval(function searchFirst(latitude,longitude,first_name) {
//
//             $.get('https://deadline/searchFirst/'+tokenMap + '/' +id_map,{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {
//
//                 console.log(match);
//
//                 $.each(match, function (i, val) {
//
//                     glatval = val.latitude;
//                     glngval = val.longitude;
//                     gname = val.first_name;
//                     GLatLng = new google.maps.LatLng(glatval,glngval);
//                     createMarker(GLatLng,gname);
//                 });
//             });
//
//         },5000);
//
//     }
//
//     function fail(positionError) {
//         console.log('Нету вашего местоположения');
//         console.log(positionError);
//
//         map = new google.maps.Map(document.getElementById('map'), {
//             center: {lat: 49.9830761, lng: 36.2345538},
//             zoom: 12
//         });
//
//         var showLocation = setInterval(function searchFirst(latitude,longitude,first_name) {
//             $.get('https://deadline/searchFirst/'+tokenMap + '/' +id_map ,{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {
//
//                 console.log(match);
//
//                 $.each(match, function (i, val) {
//                     glatval = val.latitude;
//                     glngval = val.longitude;
//                     gname = val.first_name;
//                     GLatLng = new google.maps.LatLng(glatval,glngval);
//                     createMarker(GLatLng,gname);
//                 });
//             });
//
//         },2000);
//     }
//
//     function createMarker(latlng,name) {
//
//         var marker = new google.maps.Marker({
//             position: latlng,
//             map: map,
//             title: name
//         });
//
//     }
//
// });
//
// var markerCourier = window.location.href.split("/")[4];
// var markerClient = window.location.href.split("/")[5];
// var numberClient = window.location.href.split("/")[6];
// console.log(markerCourier);
// console.log(markerClient);
// console.log(numberClient);
//
//     function checkMobileOS() {
//
//     var MobileUserAgent = navigator.userAgent || navigator.vendor || window.opera;
//
//     if (MobileUserAgent.match(/iPad/i) || MobileUserAgent.match(/iPhone/i) || MobileUserAgent.match(/iPod/i)) {
//
//         return 'iOS';
//
//     } else if (MobileUserAgent.match(/Android/i)) {
//
//         return 'Android';
//
//     } else {
//
//         return 'unknown';
//
//     }
//
// }
//
// var message_text = 'https://ok.findme.php.a-level.com.ua/map/'+markerCourier+'/'+markerClient;
//
// var href = '';
//
// if (checkMobileOS() == 'iOS') {
//
//     href = "sms:+38"+numberClient+"?body=" + encodeURI(message_text);
//
// }
//
// if (checkMobileOS() == 'Android') {
//
//     href = "sms:+38"+numberClient+"?body=" + encodeURI(message_text);
//
// }
//
// document.getElementById("sms_link").setAttribute('href', href);
