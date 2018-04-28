
var myLatLng;
var latit;
var lngit;
var latMap;
var lngMap;
var map;
var markerMy = null;
var markersClient = null;
var markersCourier = null;
var resultsClient = null;
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

        myLatLng = new google.maps.LatLng(latval,lngval);

        console.log([latval,lngval]);

        createMap(myLatLng);



        function createMap(myLatLng) {

            map = new google.maps.Map(document.getElementById('map'), {

                center: myLatLng,

                zoom: 12

            });
        }

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (position) {
                // присваимаем переменным latit и lngit координаты с watchPosition
                latit = position.coords.latitude;
                lngit = position.coords.longitude;
                // Проверяем если  latit и lngit присваиваем им значения latMap и latMap изначально они равны null и запускаем функцию geocodeLatLng
                if(latit !== latMap && lngit !== latMap){
                    latMap = latit;
                    lngMap = lngit;
                    geocodeLatLng(geocoder, map, infowindow);
                    console.log('новая метка');
                }
            });
        }

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        function geocodeLatLng(geocoder, map, infowindow) {


            var latlng = {lat: latMap, lng: lngMap};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {

                    if (results[3]) {

                        function createMarkerMy() {
                            markerMy = new google.maps.Marker({
                                position: latlng,
                                animation: google.maps.Animation.BOUNCE,
                                map: map
                            });
                            // infowindow = new google.maps.InfoWindow;
                            infowindow.setContent('You are here '+ results[0].formatted_address);
                            // infowindow.open(map, markerMy);
                            markerMy.addListener('click', function() {
                                infowindow.open(map, markerMy);
                            });

                            resultsClient = "Вы находитесь "+results[0].formatted_address;
                            document.getElementById("resultsClient").innerHTML = resultsClient;
                        }

                        if (markerMy !== null ){
                            markerMy.setMap(null);
                            markerMy = null;

                            createMarkerMy();
                        }else {
                            createMarkerMy();
                        }


                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }

            });
        }
        // var infoWindow = new google.maps.InfoWindow({map: map});
        //
        // if (navigator.geolocation) {
        //     navigator.geolocation.watchPosition(function (position) {
        //         // debugger;
        //         var positionCourier = {
        //             lat: position.coords.latitude,
        //             lng: position.coords.longitude
        //         };
        //
        //         infoWindow.setPosition(positionCourier);
        //         infoWindow.setContent('Ваше место положение');
        //
        //     }, function () {
        //         handleLocationError(true, infoWindow, map.getCenter());
        //     });
        // } else {
        //         // Browser doesn't support Geolocation
        //     handleLocationError(false, infoWindow, map.getCenter());
        // }

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
                infowindowsCourier.setContent('The label courier in ' + date );
                infowindowsCourier.open(map, markersCourier);
            }

            if (markersCourier !== null ){
                markersCourier.setMap(null);
                markersCourier = null;

                createMarkerCourier();
            }else {
                createMarkerCourier();
            }

        }else if(name == 'ClientMark'){
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
                infowindowsClient.setContent('The label sent to the courier in ' + date );
                infowindowsClient.open(map, markersClient);
            }

            if (markersClient !== null ){
                markersClient.setMap(null);
                markersClient = null;

                createMarkerClient()
            }else {
                createMarkerClient()
            }
        }
    }
    // function createMarker(latlng,name,date) {
    //         if (markers !== null ){
    //             markers.setMap(null);
    //             markers = null;
    //
    //             markers = new google.maps.Marker({
    //                 position: latlng,
    //                 map: map,
    //                 animation: google.maps.Animation.BOUNCE,
    //                 title: name
    //             });
    //
    //             infowindows.setContent('The label sent to the courier in ' + date );
    //             infowindows.open(map, markers);
    //         }else {
    //             markers = new google.maps.Marker({
    //                 position: latlng,
    //                 map: map,
    //                 animation: google.maps.Animation.BOUNCE,
    //                 title: name
    //             });
    //
    //             infowindows.setContent('The label sent to the courier in ' + date );
    //             infowindows.open(map, markers);
    //         }
    // }
});



var markerClient = window.location.href.split("/")[5];

function getLocation() {

    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(function (position) {
            lat = position.coords.latitude;
            lng = position.coords.longitude;



            $.ajax({
                url: '/map',
                type: 'POST',
                dataType: 'json',
                data: {'lat': lat,  'lng': lng, '_token': tok ,'id_map': markerClient},


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





// function nearbySearch(myLatLng, type) {
//     var request = {
//         location: myLatLng,
//         radius: '112500',
//         type: [type]
//     };
//
//     var service = new google.maps.places.PlacesService(map);
//     console.log(service);
//     service.nearbySearch(request, callback);
//
//     function callback(results, status) {
//         //console.log(results)
//         if(status == google.maps.places.PlacesServiceStatus.OK){
//             for (var i = 0; i < results.length; i++){
//                 var place = results[i];
//                 console.log(place);
//                 latlng = place.geometry.location;
//                 // noinspection JSAnnotator
//                 name = place.name;
//                 //icn = place.icon;
//                 icn = 'https://image.flaticon.com/icons/png/128/83/83551.png';
//                 createMarker(latlng,icn,name);
//             }
//         }
//     }
// }



// $(document).ready(function(){
//     $.get('https://sendloc/searchFirst',{lat:lat,lng:lng},function (match) {
//                 console.log(match);
//
//             });
// });
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
//             alert("Browser not supported")
//         }
//     }
//
//     function success(position) {
//
//         console.log(position);
//
//         var latval = position.coords.latitude;
//         var lngval = position.coords.longitude;
//
//         myLatLng = new google.maps.LatLng(latval,lngval);
//
//         createMap(myLatLng);
//
//         nearbySearch(myLatLng, "school");
//     }
//
//     function fail(positionError) {
//         if (window.console) {
//             console.log(positionError);
//         }
//     }
//
//
//
//     function createMap(myLatLng) {
//
//         map = new google.maps.Map(document.getElementById('map'), {
//
//             center: myLatLng,
//
//             zoom: 12
//
//         });
//
//         var marker = new google.maps.Marker({
//             position: myLatLng,
//             map: map
//         });
//     }
//
//     function createMarker(latlng, icn,name) {
//
//         var marker = new google.maps.Marker({
//             position: latlng,
//             map: map,
//             icon: icn,
//             title: name
//         });
//     }
//
//     function nearbySearch(myLatLng, type) {
//         var request = {
//             location: myLatLng,
//             radius: '112500',
//             type: [type]
//         };
//
//         var service = new google.maps.places.PlacesService(map);
//         console.log(service);
//         service.nearbySearch(request, callback);
//
//         function callback(results, status) {
//             //console.log(results)
//             if(status == google.maps.places.PlacesServiceStatus.OK){
//                 for (var i = 0; i < results.length; i++){
//                     var place = results[i];
//                     console.log(place);
//                     latlng = place.geometry.location;
//                     // noinspection JSAnnotator
//                     name = place.name;
//                     //icn = place.icon;
//                     icn = 'https://image.flaticon.com/icons/png/128/83/83551.png';
//                     createMarker(latlng,icn,name);
//                 }
//             }
//         }
//     }
// });

// $(document).ready(function () {
//
//     var myLatLng = new google.maps.LatLng(49.9878609,36.2302829);
//
//     var map = new google.maps.Map(document.getElementById('map'), {
//
//         center: myLatLng,
//
//         zoom: 12
//
//         });
//
//     function createMarker(latlng, icn,name) {
//
//         var marker = new google.maps.Marker({
//             position: latlng,
//             map: map,
//             icon: icn,
//             title: name
//         });
//     }
//
//     var request = {
//         location: myLatLng,
//         radius: '2500',
//         types: ['school']
//     };
//
//     service = new google.maps.places.PlacesService(map);
//     console.log(service);
//     service.nearbySearch(request, callback);
//
//     function callback(results, status) {
//         //console.log(results)
//         if(status == google.maps.places.PlacesServiceStatus.OK){
//             for (var i = 0; i < results.length; i++){
//                 var place = results[i];
//                 console.log(place);
//                 latlng = place.geometry.location;
//                 // noinspection JSAnnotator
//                 name = place.name;
//                 icn = place.icon;
//                 //icn = 'https://image.flaticon.com/icons/png/128/83/83551.png';
//                 createMarker(latlng,icn,name);
//             }
//         }
//     }
// });
