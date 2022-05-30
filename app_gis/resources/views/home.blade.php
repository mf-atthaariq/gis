<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS WEB GIS</title>

    <!-- Leaflet CSS-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>

    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@3.0.8/dist/esri-leaflet.js"
    integrity="sha512-E0DKVahIg0p1UHR2Kf9NX7x7TUewJb30mxkxEm2qOYTVJObgsAGpEol9F6iK6oefCbkJiA4/i6fnTHzM6H1kEA=="
    crossorigin=""></script>
    
    <!-- JQuery 3.6.0 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
       #map { height: 600px; }

       .label-bidang {
           font-size: 8pt;
           color: #ffffff;
           text-align: center;
       }
    </style>
</head>
<body>
UAS WEB GIS
<div id="map"></div>
</body>

<script>
    var map = L.map('map').setView([-0.0240613,109.3467576], 13);
    
    // Basemap Google
    // Hybrid: s,h; Satellite: s; Streets: m; Terrain: p;
    L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

    // Basemap Esri
    // L.esri.basemapLayer('Topographic').addTo(map);

    /* Basemap MapBox (openstreet)
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);
    */
    
    
    //var maker = L.marker([-0.0240613,109.3467576], {icon: myIcon}).addTo(map).on('click', function(e) {
    //    alert(e.LatLng);});
    
    // marker
    // L.marker([-0.0240613,109.3467576], {icon: myIcon}).addTo(map);

    // GeoJSON PETA PNK
    $.getJSON('assets/geojson/map.geojson', function(json) {
        geoLayer = L.geoJSON(json, {
            style: function(feature) {
                return {
                    fillOpacity: 0.3,
                    weight: 3,
                    opacity: 1,
                    color: "#f5ca9d",

                    dashArray: "8 15",
                    lineCap: "round"
                };
            },

            onEachFeature: function(feature, layer){
                var iconLabel = L.divIcon({
                    className: 'label-bidang',
                    html: '<b>'+feature.properties.nama+'</b>',
                    iconSize: [100, 20]
                });
                L.marker(layer.getBounds().getCenter(),{icon:iconLabel}).addTo(map);
                // alert(feature.properties.nama)
                
                // layer.on('click',(e)=>{
                //     alert(feature.properties.nama);
                // })
                
                layer.addTo(map);
            }
        });
    });

/*
    // TITIK
    $( document ).ready(function() {
        $.getJSON('titik/data', function(data) {
            // ambil semua data titik
            $.each(data, function(index) {
                // alert(data[index].nama)
                var myIcon = L.icon({
                    iconUrl: 'assets/icons/repair.png',
                    iconSize: [30, 30],
                    iconAnchor: [0,20],
                    popupAnchor: [-3, -76],
                });
                L.marker([parseFloat(data[index].lat),parseFloat(data[index].lng)],{icon:myIcon}).addTo(map);
                
            })
        });
    });
*/
    var myIcon = L.icon({
        iconUrl: 'assets/icons/repair.png',
        iconSize: [30, 30],
        iconAnchor: [0,20],
        popupAnchor: [-3, -76],
    });

    //GeoJSON TITIK
    $.getJSON('assets/geojson/titik.geojson', function(json) {
        geoLayer = L.geoJSON(json, {
            pointToLayer: function (feature, latlng) {
                return L.marker(latlng, {icon: myIcon});
            },

            onEachFeature: function(feature, layer){
                /*
                var html = 'Nama: ' + feature.properties.nama;
                    html +='Foto: ' + '<img height="100px" src="assets/images/'+detail[index].foto+'">';
                
                
                layer.bindPopup(html);
                */
                /*
                layer.on('click', (e)=>{
                    $.getJSON('titik/'+feature.properties.id, function(json) {
                        $.each(data, function(index) {
                            alert(detail[index].nama);
                        })
                    })
                })
                */
                // alert(feature.properties.nama)
                var myIcon = L.icon({
                    iconUrl: 'assets/icons/repair.png',
                    iconSize: [30, 30],
                    iconAnchor: [0,20],
                    popupAnchor: [-3, -76],
                });

                layer.on('click',(e)=>{
                    $( document ).ready(function() {
                        $.getJSON('titik/'+feature.properties.id, function(detail) {
                            $.each(detail, function(index) {
                                
                                var html='Nama: '+detail[index],nama;
                                L.popup()
                                    .setLatLng(latlng)
                                    .setContent(html)
                                    .openOn(map);

                            })
                        })
                    })
                    
                    alert('Nama: '+feature.properties.nama+'\nFoto: <img height="100px" src="assets/images/'+feature.properties.foto+'.jpg">');
                })
                
                layer.addTo(map);
            }
        });
    });

</script>
</html>