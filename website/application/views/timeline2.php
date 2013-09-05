    <script src='http://api.tiles.mapbox.com/mapbox.js/v0.6.7/mapbox.js'></script>
    <link href='http://api.tiles.mapbox.com/mapbox.js/v0.6.7/mapbox.css' rel='stylesheet' />
    <style>
	#map {
	    padding: 0;
	    width: 100%;
	    height: 700px;
	}
	
	#sidebar {
	    background:#666;
	}
	 
	#sidebar:hover { opacity:0.8; }
       
	#timeline {
	    padding:10px;
	}
	#timeline a {
	    font-size:12px;
	    text-decoration:none;
	}
	#controls {
	    text-align: center;
	    margin: 0 auto 10px auto;
	}
	#controls a {
	    font-size:25px;
	    color:#DC1438;
	    margin-left:10px;
	}
	a.#sidebar  {color: #000;}   
	a.year-active {
	    color:#DC1438;
	}
    </style>
    <header class="codrops-header">
	<a href="/abroadplay/" title="公務員出國考察追蹤網-Home">
	    <h1>公務員出國考察追蹤網<span>追蹤公務員出國考察的、行程、人數</span></h1>
	</a>
    </header>
    <div id='controls'></div>
    <div id='map'></div>
    <div id='sidebar'>
	<div id='timeline'></div>
    </div>
    <script>
    <!--
	var map = mapbox.map('map');
	map.addLayer(mapbox.layer().id('mapbox.geography-class'));
      
	var timeline = document.getElementById('timeline'),
	    controls = document.getElementById('controls');
      
	var markerLayer = mapbox.markers.layer()
	    // this is a quick optimization - otherwise all markers are briefly displayed
	    // before filtering to 2001
	    .filter(function() { return false })
	    .url('/historical_earthquakes.geojson', function(err, features) {
      
	    // A closure for clicking years. You give it a year, and it returns a function
	    // that, when run, clicks that year. It's this way in order to be used as both an
	    // event handler and run manually.
	    function click_year(y) {
		return function() {
		    var active = document.getElementsByClassName('year-active');
		    if (active.length) active[0].className = '';
		    document.getElementById('y' + y).className = 'year-active';
		    markerLayer.filter(function(f) {
			return f.properties.year == y;
		    });
		    return false;
		};
	    }
      
	    var years = {},
		yearlist = [],
		year_links = [];
      
	    for (var i = 0; i < features.length; i++) {
		years[features[i].properties.year] = true;
	    }
      
	    for (var y in years) yearlist.push(y);
	    yearlist.sort();
      
	    for (var i = 0; i < yearlist.length; i++) {
		var a = timeline.appendChild(document.createElement('a'));
		a.innerHTML = yearlist[i] + ' ';
		a.id = 'y' + yearlist[i];
		a.href = '#';
		a.onclick = click_year(yearlist[i]);
	    }
      
	    var stop = controls.appendChild(document.createElement('a')),
		  play = controls.appendChild(document.createElement('a')),
		  playStep;
      
	    stop.innerHTML = 'STOP ■';
	    play.innerHTML = 'PLAY ▶';
      
	    play.onclick = function() {
		var step = 0;
		// Every quarter-second (250 ms) increment the year
		// we're looking at and show a new year. When
		// the end is reached, call clearInterval to stop
		// the animation.
		playStep = window.setInterval(function() {
		    if (step < yearlist.length) {
			click_year(yearlist[step])();
			step++;
		    } else {
			window.clearInterval(playStep);
		    }
		}, 250);
	    };
      
	    stop.onclick = function() {
		window.clearInterval(playStep);
	    };
      
	    click_year(2001)();
	});
 	map.addLayer(markerLayer);
	map.zoom(2).center({ lat: 40, lon: -200 });
    //-->
    </script>    


