function openModal() {
	$('#eventModal').modal('show');
}

function addEvent() {
	$('#addModal').modal('show');
}

function editEvent() {
	$('#editModal').modal('show');
}

function deleteEvent() {
	$('#deleteModal').modal('show');
}

function cancelAddEvent() {
	$('#addModal').modal('hide');
}

function cancelEditEvent() {
	$('#editModal').modal('hide');
}

var placeSearch, autocomplete;

function initialize() {
	autocomplete = new google.maps.places.Autocomplete(
	/** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
	{ types: ['geocode'] });
	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		fillInAddress();
	});
}

function fillInAddress() {
	var place = autocomplete.getPlace();	
	var plaats = $('#autocomplete').val();
	var replaced = plaats.replace(/\s+/g, '+');
	var url = "https://www.google.com/maps/embed/v1/place?key=AIzaSyARMLp4OYW9VYpOvYS_SmSwsb2F2vHEwRY&q=" + replaced;
	$('#map-canvas').attr('src', url); 
}

function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = new google.maps.LatLng(
			position.coords.latitude, position.coords.longitude);
			var circle = new google.maps.Circle({
				center: geolocation,
				radius: position.coords.accuracy
			});
			autocomplete.setBounds(circle.getBounds());
		});
	}
}
