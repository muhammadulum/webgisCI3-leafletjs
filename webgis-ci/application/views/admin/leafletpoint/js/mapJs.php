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
	<script src="<?=base_url('assets/node_modules/leaflet-easyprint/dist/bundle.js')?>"></script>
	<script src="<?=base_url('assets/js/leaflet-search/dist/leaflet-search.src.js')?>"></script>
	<script src="<?=site_url('admin/api/data/kecamatan')?>"></script>
	<script src="<?=site_url('admin/api/data/kategoriwisata')?>"></script>

   <script type="text/javascript">
   	var map = L.map('map').setView([-2.1926273,109.7104685], 10);
   	var layersKecamatan=[];
   	var layersKategoriwisata=[];
   	// var Layer=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
	//     attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	//     maxZoom: 18,
	//     id: 'mapbox.streets',
	//     accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
	// });

	var Layer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});


	var Layer2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	});

	var Layer3 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/dark-v10'
    });

	var roadMutant = L.gridLayer.googleMutant({
			maxZoom: 24,
			type:'roadmap'
	});

	map.addLayer(Layer);
	// easy print
	L.easyPrint({
		title: 'Leaflet EasyPrint',
		position: 'topleft',
		exportOnly: true,
		filename :'WebGIS CI',
		sizeModes: ['Current','A4Portrait', 'A4Landscape']
	}).addTo(map);
	// pengaturan legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
	}


	function iconByImage(image) {
		return '<img src="'+image+'" style="width:16px">';
	}


	var baseLayers = [
		{
			name: "OpenStreetMap",
			layer: Layer
		},
		{	
			name: "OpenLightMap",
			layer: Layer2
		},
		// {
		// 	name: "Outdoors",
		// 	layer: L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
		// },
		{
			name:'Satelite Google',
			layer : L.gridLayer.googleMutant({
				maxZoom: 24,
				type:'satellite'
			})
		},
		{
			name: "OpenDarkMap",
			layer: Layer3
		}
	];
	// Akhir konfigurasi
	// pengaturan untuk layer kecamatan
	function getColorKecamatan(KECNO){
		for(i=0;i<dataKecamatan.length;i++){
			var data=dataKecamatan[i];
			if(data.kd_kecamatan==KECNO){
				return data.warna_kecamatan;
			}
		}
	}
	function popUp(f,l){
	    var html='';
	    if (f.properties){
	    	html+='<table>';
	    	html+='<tr>';
		    	html+='<td colspan="3"><img src="<?=base_url('assets/icon-map.png')?>" width="100%"></td>';
	    	html+='</tr>';
	    	html+='<tr>';
		    	html+='<td>Provinsi</td>';
		    	html+='<td>:</td>';
		    	html+='<td>'+f.properties['PROVINSI']+'</td>';
	    	html+='</tr>';
	    	html+='<tr>';
		    	html+='<td>Kecamatan</td>';
		    	html+='<td>:</td>';
		    	html+='<td>'+f.properties['KECAMATAN']+'</td>';
	    	html+='</tr>';
	    	html+='</table>';
	    	html+='<a href="<?=site_url('kecamatan')?>" target="_BLANK">'
	    			+'<button  class="btn btn-info btn-sm" ><i class="fa fa-info"></i> Info</button></a>';
	        l.bindPopup(html);
	    }
	}

	for(i=0;i<dataKecamatan.length;i++){
		var data=dataKecamatan[i];
		var layer={
			name: data.nm_kecamatan,
			icon: iconByName(data.warna_kecamatan),
			layer: new L.GeoJSON.AJAX(["<?=base_url('assets/unggah/geojson')?>/"+data.geojson_kecamatan],
				{
					onEachFeature:popUp,
					style: function(feature){
						var KECNO=feature.properties.KECNO;
						return {
							"color": getColorKecamatan(KECNO),
						    "weight": 1,
						    "opacity": 1
						}

					},
				}).addTo(map)
			}
		layersKecamatan.push(layer);
	}
	//kategori hotspot
	for(i=0;i<dataKategoriwisata.length;i++){
		var data=dataKategoriwisata[i];
		var layer={
			name: data.nm_kategori_wisata,
			icon: iconByImage(data.icon),
			layer: new L.GeoJSON.AJAX(["<?=site_url('admin/api/data/wisata/point')?>/"+data.id_kategori_wisata],
				{
					 pointToLayer: function (feature, latlng) {
				    	// console.log(feature)
				        return L.marker(latlng, {
				        	icon : new L.icon({
				        			iconUrl: feature.properties.icon,
							    	iconSize: [38, 45]
			        				})
				        });
				    },
			    	onEachFeature: function(feature,layer){
			    		 if (feature.properties && feature.properties.name) {
					        layer.bindPopup(feature.properties.popUp);
					    }
			    	}
				}).addTo(map)
			}
		layersKategoriwisata.push(layer);
	}
	// end pengaturan untuk layer kecamatan

	// akhir dari hotspot
	// pencarian
	// var poiLayers = L.layerGroup([
	// 	layersHotspotPoint
	// ]);
	// L.control.search({
	// 	layer: poiLayers,
	// 	initial: false,
	// 	propertyName: 'name',
	// 	buildTip: function(text, val) {
	// 		// var jenis = val.layer.feature.properties.jenis;
	// 		// return '<a href="#" class="'+jenis+'">'+text+'<b>'+jenis+'</b></a>';
	// 		return '<a href="#" >'+text+'</a>';
	// 	},
	// 	marker: {
	// 		icon: "",
	// 		circle: {
	// 			radius: 20,
	// 			color: '#f32',
	// 			opacity: 1,
	// 			weight:5
	// 		}
	// 	}
	// }).addTo(map);
	// end pencarian



	// registrasikan untuk panel layer
	var overLayers = [{
		group: "Layer Kecamatan",
		layers: layersKecamatan
	},{
		group: "Kategori Hotspot",
		layers: layersKategoriwisata
	}
	];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});

	map.addControl(panelLayers);
	// end registrasikan untuk panel layer



   </script>