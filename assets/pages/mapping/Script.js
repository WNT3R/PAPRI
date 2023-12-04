var map = L.map('map').setView([13.5, 120.5], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Function to add a marker on map click
function addMarker(e) {
    var marker = L.marker(e.latlng).addTo(map);
    var markerName = prompt('Enter a name for the marker:');
    
    if (markerName) {
        marker.bindPopup(markerName).openPopup();
        
        // Store the marker data in the database via AJAX
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_marker.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('name=' + markerName + '&lat=' + lat + '&lng=' + lng);
    }
}

// Attach the click event to the map
map.on('click', addMarker);

// Function to remove a marker
function removeMarker(e) {
    map.removeLayer(e.target);
    
    // Delete the marker from the database via AJAX
    var markerId = e.target.options.id;
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'remove_marker.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send('id=' + markerId);
}

// Attach a click event to remove markers
map.on('popupclose', removeMarker);
