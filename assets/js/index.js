import 'ol/ol.css';
import Map from 'ol/Map';
import View from 'ol/View';
import KML from 'ol/format/KML';

import {
	Tile as TileLayer,
	Vector as VectorLayer
} from 'ol/layer';
import BingMaps from 'ol/source/BingMaps';
import VectorSource from 'ol/source/Vector';

var raster = new TileLayer({
	source: new BingMaps({
		imagerySet: 'Aerial',
		key: 'ApO5fTEGMsEzMbeUTbRCHZK6fgAcB4e6gmNCm2AX0F_8LVSgMZRVyS7SSnbHChxo'
	})
});

var vector = new VectorLayer({
	source: new VectorSource({
		url: 'http://timca.rf.gd/teamca/assets/kml/test.kml',
		format: new KML()
	})
});

var map = new Map({
	layers: [raster, vector],
	target: document.getElementById('map'),
	view: new View({
		center: [876970.8463461736, 5859807.853963373],
		projection: 'EPSG:3857',
		zoom: 10
	})
});

var displayFeatureInfo = function (pixel) {
	var features = [];
	map.forEachFeatureAtPixel(pixel, function (feature) {
		features.push(feature);
	});
	if (features.length > 0) {
		var info = [];
		var i, ii;
		for (i = 0, ii = features.length; i < ii; ++i) {
			info.push(features[i].get('name'));
		}
		document.getElementById('info').innerHTML = info.join(', ') || '(unknown)';
		map.getTarget().style.cursor = 'pointer';
	} else {
		document.getElementById('info').innerHTML = '&nbsp;';
		map.getTarget().style.cursor = '';
	}
};

map.on('pointermove', function (evt) {
	if (evt.dragging) {
		return;
	}
	var pixel = map.getEventPixel(evt.originalEvent);
	displayFeatureInfo(pixel);
});

map.on('click', function (evt) {
	displayFeatureInfo(evt.pixel);
});
