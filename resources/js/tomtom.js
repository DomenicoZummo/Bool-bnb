
import tt from '@tomtom-international/web-sdk-maps';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';


let lat = document.getElementById('lat');
let lng = document.getElementById('lng');
let address = document.getElementById('address');

function handleResultsFound(event) {
    var results = event.data.results.fuzzySearch.results;

    if (results.length === 0) {
        searchMarkersManager.clear();
    }
    searchMarkersManager.draw(results);
    fitToViewport(results);
}

function handleResultSelection(event) {
    var result = event.data.result;
    if (result.type === "category" || result.type === "brand") {
        return;
    }
    searchMarkersManager.draw([result]);
    fitToViewport(result);
}

function fitToViewport(markerData) {
    if (
        !markerData ||
        (markerData instanceof Array && !markerData.length)
    ) {
        return;
    }
    var bounds = new tt.LngLatBounds();
    if (markerData instanceof Array) {
        markerData.forEach(function (marker) {
            bounds.extend(getBounds(marker));
        });
    } else {
        bounds.extend(getBounds(markerData));
    }
    map.fitBounds(bounds, { padding: 100, linear: true });
} 
function getBounds(data) {
    var btmRight;
    var topLeft;

    lat.value  = data.position.lat;
    lng.value = data.position.lng;
    address.value = data.address.freeformAddress;

    // lat = data.position.lat;
    // lng = data.position.lng;
    // address = data.address.freeformAddress;
    
    // console.log(this.lat);
    // console.log(lat);
    // console.log(lng.value);

    if (data.viewport) {
        btmRight = [
            data.viewport.btmRightPoint.lng,
            data.viewport.btmRightPoint.lat,
        ];
        topLeft = [
            data.viewport.topLeftPoint.lng,
            data.viewport.topLeftPoint.lat,
        ];
    }

    
    return [btmRight, topLeft];
}

function handleResultClearing() {
    searchMarkersManager.clear();
}

function SearchMarkersManager(map, options) {
    this.map = map;
    this._options = options || {};
    this._poiList = undefined;
    this.markers = {};
}

SearchMarkersManager.prototype.draw = function (poiList) {
    this._poiList = poiList;
    this.clear();
    this._poiList.forEach(function (poi) {
        var markerId = poi.id;
        var poiOpts = {
            name: poi.poi ? poi.poi.name : undefined,
            address: poi.address ? poi.address.freeformAddress : "",
            distance: poi.dist,
            classification: poi.poi
                ? poi.poi.classifications[0].code
                : undefined,
            position: poi.position,
            entryPoints: poi.entryPoints,
        };
        var marker = new SearchMarker(poiOpts, this._options);
        marker.addTo(this.map);
        this.markers[markerId] = marker;
    }, this);
};

SearchMarkersManager.prototype.clear = function () {
    for (var markerId in this.markers) {
        var marker = this.markers[markerId];
        marker.remove();
    }
    this.markers = {};
    this._lastClickedMarker = null;
};

function SearchMarker(poiData, options) {
    this.poiData = poiData;
    this.options = options || {};
    this.marker = new tt.Marker({
        element: this.createMarker(),
        anchor: "bottom",
    });
    var lon = this.poiData.position.lng || this.poiData.position.lon;
    this.marker.setLngLat([lon, this.poiData.position.lat]);
}

SearchMarker.prototype.addTo = function (map) {
    this.marker.addTo(map);
    this._map = map;
    return this;
};

SearchMarker.prototype.createMarker = function () {
    var elem = document.createElement("div");
    elem.className = "tt-icon-marker-black tt-search-marker";
    if (this.options.markerClassName) {
        elem.className += " " + this.options.markerClassName;
    }
    var innerElem = document.createElement("div");
    innerElem.setAttribute(
        "style",
        "background: white; width: 10px; height: 10px; border-radius: 50%; border: 3px solid black;"
    );

    elem.appendChild(innerElem);
    return elem;
};

SearchMarker.prototype.remove = function () {
    this.marker.remove();
    this._map = null;
};


 var options = {
    searchOptions: {
        key: "gKIZzIyagJPsNGDOLL9WGenkQlFeapDb",
        language: "it-IT",
        limit: 5,
    },       
};


tt.setProductInfo("BoolBnB", "1.0");
var map = tt.map({
    key: "gKIZzIyagJPsNGDOLL9WGenkQlFeapDb",
    container: "map",
    center: [12, 41],
    zoom: 4,
});
// var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
const ttSearchBox = new SearchBox(services, options);
var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
document.getElementById('searchbox-back').prepend(searchBoxHTML) ;
// var inputSearchBox = document.querySelector('.tt-search-box-input');
// inputSearchBox.value = `via stazione`;
// console.log(inputSearchBox.value);
var searchMarkersManager = new SearchMarkersManager(map);
ttSearchBox.on("tomtom.searchbox.resultselected", handleResultSelection); // CHIAMATA ON CLICK  
ttSearchBox.on("tomtom.searchbox.resultscleared", handleResultClearing);


 