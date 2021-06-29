	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/js/leaflet-search/dist/leaflet-search.min.css')?>">
	<style type="text/css">
		
		.search-tip b {
			display: inline-block;
			clear: left;
			float: right;
			padding: 0 4px;
			margin-left: 4px;
		}

		.Banjir.search-tip b,
		.Banjir.leaflet-marker-icon {
			background: #f66
		}
	</style>
<!-- Make sure you put this AFTER Leaflet's CSS -->
 	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHqhgVQmhdp3XAJ91LHRdXJ3YOjP1V2Gs" async defer></script>
	<script src="<?=base_url('assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js')?>"></script>
	<script src="<?=base_url('assets/js/leaflet.ajax.js')?>"></script>
	<script src="<?=base_url('assets/js/Leaflet.GoogleMutant.js')?>"></script>
	<script src="<?=base_url('assets/js/leaflet-search/dist/leaflet-search.src.js')?>"></script>
	<script src="<?=site_url('admin/api/data/hotspot/polygon')?>"></script>

   <script type="text/javascript">
   	var map = L.map('map').setView([-3.824181, 114.8191513], 10);
   	var layersKecamatan=[];
   	var Layer=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	    maxZoom: 18,
	    id: 'mapbox.streets',
	    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	});
	var roadMutant = L.gridLayer.googleMutant({
			maxZoom: 24,
			type:'roadmap'
	});

	map.addLayer(Layer);


	// tambahkan polygon
	var polygon=[];
	var multipolygon=[];
	console.log(latlngs);
	for(i=0;i<latlngs.length;i++){
	 multipolygon[i] = new L.FeatureGroup();
	 map.addLayer(multipolygon[i]);
	 polygon[i] = L.polygon(latlngs[i], {color: 'red'}).addTo(multipolygon[i]);

	}

   </script>