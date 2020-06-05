<form id="ServiceRequest" action="<?= current_url() ?>" method='post'>
<script type="text/javascript" src="https://raw.github.com/HPNeo/gmaps/master/gmaps.js"></script>
<!-- dropdown service id  !-->
<div class="form-group">
    <label class="control-label">ServiceType:</label>
    <select name="Service_type" class="form-control" id="ServiceId">
        <option>--all--</option>
        <option value="1" selected>Service One</option>
        <option value="2">Service Two</option>
    </select>
</div>

<div class="form-group">
    <!-- provider_counter service id  !-->
    <label for="provider_counter" class="control-label">Closest Providers :</label>
    <div class="text-lg-center alert-danger"id="info"></div>
    <!-- display map  !-->
    <div id="map" style="height: 1000px; width:1000px;"></div>
    <!-- current latituide and longtuide  !-->
    <input id="lat" type="hidden" value="" />
    <input id="lng" type="hidden" value="" />
    <button type="button" onclick="RelatedLocationAjax();">show_closest_providers</button>
</div>

<div id='submit_button'>
    <input class="btn btn-success" type="submit" name="submit" value="add comment"/>
</div>
</form>
<script>

    var lat = document.getElementById("lat"); // this will select the input with id = lat 
    var lng = document.getElementById("lng"); // this will select the input with id = lng   
    var info = document.getElementById("info"); // this will select the current div  with id = info 
    
 console.log(lat+""+lng);
    var ServiceId = document.getElementById("ServiceId"); // this will select the input with id = ServiceId 
    var locations = [];
    var km = 30; // this kilometers used to specify circle wide when use drawcircle function
    var Crcl ; // circle variable
    var map; // map variable
    var mapOptions = {
        zoom: 11,
        center: {lat:24.774265, lng:46.738586}
    }; // map options
    var markers = []; // markers array ,we will fill it dynamically
    var infoWindow = new google.maps.InfoWindow(); // information window ,we will use for our location and for markers
    // this will initiate when load the page and have all
    function initialize() {
        // set the map to the div with id = map and set the mapOptions as defualt
        map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

        var infoWindow = new google.maps.InfoWindow({map: map});

        // get current location with HTML5 geolocation API.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                lat.value  =  position.coords.latitude ;
                lng.value  =  position.coords.longitude;
                info.nodeValue =  position.coords.longitude;
                // set the current posation to the map and create info window with (Here Is Your Location) sentense
                infoWindow.setPosition(pos);
                infoWindow.setContent('Here Is Your Location.');
                // set this info window in the center of the map 
                map.setCenter(pos);
                // draw circle on the map with parameters
                DrowCircle(mapOptions, map, pos, km);

            }, function() {
                // if user block the geolocatoon API and denied detect his location
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());

        }
    }
    // to handle user denied
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: User Has Denied Location Detection.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

    // to draw circle around 30 kilometers to current location
    function DrowCircle(mapOptions, map, pos, km ) {
        // var populationOptions = {
        //     strokeColor: '#FF0000',
        //     strokeOpacity: 0.8,
        //     strokeWeight: 2,
        //     fillColor: '#FF0000',
        //     fillOpacity: 0.35,
        //     map: map,
        //     center: pos,
        //     radius: Math.sqrt(km*500) * 100
        // };
        // // Add the circle for this city to the map.
        // this.Crcl = new google.maps.Circle(populationOptions);
    }
    // this function to get providers with ajax request
    function RelatedLocationAjax() {
      var locations = [
        ["Sorathiya ","Do this service 1 <a href=''>more</a>",  "29.957051,71.914529", "https://maps.google.com/mapfiles/ms/icons/blue.png"],
        ["Ali", "Do this service 1 <a href=''>more</a>", "30.956051,72.913529", "https://maps.google.com/mapfiles/ms/icons/green.png"],
        ["Mahmoud","Do this service 1 <a href=''>more</a>","31.955051,72.912529", "https://maps.google.com/mapfiles/ms/icons/red.png"],
        ];
        
        add_markers(locations);
    }
    // this function to will draw markers with data returned from the ajax request
    var locations = [
        ["Sorathiya ","Do this service 1 <a href=''>more</a>",  "29.957051,30.914529", "https://maps.google.com/mapfiles/ms/icons/blue.png"],
        ["Ali", "Do this service 1 <a href=''>more</a>", "30.956051,31.913529", "https://maps.google.com/mapfiles/ms/icons/green.png"],
        ["Mahmoud","Do this service 1 <a href=''>more</a>","31.955051,32.912529", "https://maps.google.com/mapfiles/ms/icons/red.png"],
        ];
    add_markers(locations);
    function add_markers(data){
     
        var marker, i;
        var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow();
        // display how many closest providers avialable 
        document.getElementById('info').innerHTML = " Available:" + data.length + " Providers<br>";

        for (i = 0; i < data.length; i++) {
            var coordStr = data[i][2];
            var coords = coordStr.split(",");
            alert(coordStr+""+coords);
            var pt = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
            bounds.extend(pt);
            marker = new google.maps.Marker({
                position: pt,
                map: map,
                icon: data[i][3],
                address: data[i][1],
                title: data[i][0],
                html: data[i][0] + "<br>" + data[i][1]
            });
            markers.push(marker);
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(marker.html);
                    infowindow.open(map, marker);
                }
            })
            (marker, i));

        }
        // this is important part , because we tell the map to put all markers inside the circle,
        // so all results will display and centered
        ///map.fitBounds(this.Crcl.getBounds());
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABTAjNyyNGiFA1h4d6uDjJpjWNdP6AxRA&callback=initialize">
</script>