var COUNTRYMapper = {
	map: null,
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	latlngbound: null,
	infowindow: null,
	baseUrl: "http://maps.google.com/maps/api/geocode/json?components=country:",
	initializeMap: function(mapId,zoomval){
		COUNTRYMapper.latlngbound = new google.maps.LatLngBounds();
		var latlng = new google.maps.LatLng(0, 0);
		//set Map options
		var mapOptions = {
			zoom: zoomval,
			center: latlng,
			disableDefaultUI: true,
  			disableDoubleClickZoom: true,
  			keyboardShortcuts: false,
  			draggable: false,
  			scrollwheel: false,
			mapTypeId: COUNTRYMapper.mapTypeId
		}
		//init Map
		COUNTRYMapper.map = new google.maps.Map(document.getElementById(mapId), mapOptions);
		//init info window
		COUNTRYMapper.infowindow = new google.maps.InfoWindow();
		//info window close event
		google.maps.event.addListener(COUNTRYMapper.infowindow, 'closeclick', function() {
			COUNTRYMapper.map.fitBounds(COUNTRYMapper.latlngbound);
			COUNTRYMapper.map.panToBounds(COUNTRYMapper.latlngbound);
		});
	},
	addCOUNTRYArray: function(countryArray){
		countryArray = COUNTRYMapper.uniqueArray(countryArray); //get unique array elements
		//add Map Marker for each COUNTRY
		for (var i = 0; i < countryArray.length; i++){
			COUNTRYMapper.addCOUNTRYMarker(countryArray[i]);
		}
	},
	addCOUNTRYMarker: function(country){
		if($.trim(country) != ''){ //validate COUNTRY Address format
			var url = encodeURI(COUNTRYMapper.baseUrl + country + "&sensor=false"); //geocoding url
			$.getJSON(url, function(data) { //get Geocoded JSONP data
				 if(data.status=='OK'){ //Geocoding successfull
					var latitude = data.results[0].geometry['location'].lat
					var longitude = data.results[0].geometry['location'].lng;
					var contentString = '<p style="color:#000">'+data.results[0].formatted_address+'</p>';
					
					var latlng = new google.maps.LatLng(latitude, longitude);
					var marker = new google.maps.Marker({ //create Map Marker
						map: COUNTRYMapper.map,
						draggable:false,
						animation: google.maps.Animation.DROP,
						position: latlng,
						title: country
					});
					
					COUNTRYMapper.placeCOUNTRYMarker(marker, latlng, contentString); //place Marker on Map
				} else {
					COUNTRYMapper.logError('COUNTRY Address geocoding failed!');
					$.error('COUNTRY Address geocoding failed!');
				}
			});
		} else {
			COUNTRYMapper.logError('Invalid COUNTRY Address!');
			$.error('Invalid COUNTRY Address!');
		}
	},
	placeCOUNTRYMarker: function(marker, latlng, contentString){ //place Marker on Map
		marker.setPosition(latlng);
		google.maps.event.addListener(marker, 'click', function() {
			COUNTRYMapper.getCOUNTRYInfoWindowEvent(marker, contentString);
		});
		COUNTRYMapper.latlngbound.extend(latlng);
		COUNTRYMapper.map.setCenter(COUNTRYMapper.latlngbound.getCenter());
		//COUNTRYMapper.map.fitBounds(COUNTRYMapper.latlngbound);
	},
	getCOUNTRYInfoWindowEvent: function(marker, contentString){ //open Marker Info Window
		COUNTRYMapper.infowindow.close()
		COUNTRYMapper.infowindow.setContent(contentString);
		COUNTRYMapper.infowindow.open(COUNTRYMapper.map, marker);
	},
	uniqueArray: function(inputArray){ //return unique elements from Array
		var a = [];
		for(var i=0; i<inputArray.length; i++) {
			for(var j=i+1; j<inputArray.length; j++) {
				if (inputArray[i] === inputArray[j]) j = ++i;
			}
			a.push(inputArray[i]);
		}
		return a;
	},
	logError: function(error){
		if (typeof console == 'object') { console.error(error); }
	}
}

