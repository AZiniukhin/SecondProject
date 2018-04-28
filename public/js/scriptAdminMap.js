
var myLatLng;
// var latit;
// var lngit;
// var latMap;
// var lngMap;
var map;
// var markerMy = null;
var markersClient = null;
var markersCourier = [];
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

        var showLocation = setInterval(function searchAdmin(latitude,longitude,first_name) {
            $.get('https://ok.findme.php.a-level.com.ua/searchAdmin/yakitori',{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {

                console.log(match);
                deleteMarkers();

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


        var showCourier = setInterval(function searchAdmin(){
                $.get('https://ok.findme.php.a-level.com.ua/searchAdmin/yakitori', function(data) {

                var geocoder = new google.maps.Geocoder;
                // function cloc() {
                //
                //
                // }
                var output =    document.createElement('UL')
                //var output="<ul>";
                for (var i in data) {
                    var latlng = {lat: data[i].latitude, lng: data[i].longitude};

                    geocoder.geocode({'location': latlng}, function(results) {
                        output.innerHTML +="<li> Курьер " + data[i].first_name + " " + data[i].Surname + " " + " Последний раз был в " + data[i].created_at +" на "+results[0].formatted_address+"</li>";
                  //      console.log(results[0].formatted_address); // показует адрес маркера

                    });



                    //output += "<li> Курьер " + data[i].first_name + " " + data[i].Surname + " " + " Последний раз был в " + data[i].created_at +" на "+"</li>";
                    // loc ="";
                }

                    document.getElementById("placeholder").innerHTML = "";
                //output+="</ul>";
                document.getElementById("placeholder").appendChild(output)
            });
         },5000);
    }

    function setMapOnAll(map) {
        for (var i = 0; i < markersCourier.length; i++) {
            markersCourier[i].setMap(map);
        }
    }

    function clearMarkers() {
        setMapOnAll(null);
    }

    function deleteMarkers() {

        clearMarkers();
        markersCourier = [];
    }

    function fail(positionError) {
        console.log('Нету вашего местоположения');
        console.log(positionError);

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 49.9830761, lng: 36.2345538},
            zoom: 12
        });

        var showLocation = setInterval(function searchFirst(latitude,longitude,first_name) {

            $.get('https://ok.findme.php.a-level.com.ua/searchAdmin/yakitori' ,{latitude:latitude,longitude:longitude, first_name:first_name },function (match) {


                console.log(match);

                deleteMarkers();


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
    function createMarker(latlng,name) {


        var markerrr = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    // icon: 'http://www.yakitoriya-iv.ru/images/logo.png',
                    icon: {
                        url: '/icon/yakitori.png', // url
                        scaledSize: new google.maps.Size(100, 50), // scaled size
                        // origin: new google.maps.Point(0,0), // origin
                        // anchor: new google.maps.Point(0, 0) // anchor
                    },
                    // animation: google.maps.Animation.BOUNCE,
                    title: name
                });
        markersCourier.push(markerrr);


        // infowindowsCourier = new google.maps.InfoWindow;
                // infowindowsCourier.setContent('The label courier in ' + date);
                // infowindowsCourier.open(map, markersCourier);
    }
});



