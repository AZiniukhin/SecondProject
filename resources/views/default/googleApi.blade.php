<div id="map">
    <script>


        // Note: This example requires that you consent to location sharing when
        // prompted by your browser. If you see the error "The Geolocation service
        // failed.", it means you probably did not give permission for the browser to
        // locate you.

        var watchID = null;

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 10
            });
            //var infoWindow = new google.maps.InfoWindow({map: map});

            // Try HTML5 geolocation.
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
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 5000
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
            //console.log(watchID);
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
        }

    </script>

</div>



<button id="for_button" onclick="getLocation()">Share Your Position</button>
<button id="for_button" ><a href="sms:0970221752?body=https://sendloc/mymap/mytoken{{ csrf_token() }}">SMS </a></button>
<div id="res1"></div>
<div id="res2"></div>
<div id="location"></div>


<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    var x = document.getElementById("location");
    var lat = null;
    var lng = null;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function (position) {
                lat = position.coords.latitude;
                lng = position.coords.longitude;
                //debugger;
//                $("#for_button").click(function(){
                    $.ajax({
                        url: '/',
                        type: 'POST',
                        dataType: 'json',
                        data: {'lat': lat,  'lng': lng, '_token': "{{ csrf_token() }}" },


                        success: function(data) {
                            //console.log('Hello');
                            console.log(data.saved);
//                            $('#res1').html(lat + ' ' + lng);
//                            $('#res2').html(lat);

                        },
                        error: function(e) {
                            console.log(1);
                        }

                    });
//                })


            }, function () {

            }, {
                enableHighAccuracy: true,
                maximumAge: 4000
            });

        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }


    }


</script>


<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZfAbiyUKLQtj3hLsgUWnu6df9C0RjpMw&callback=initMap">
</script>