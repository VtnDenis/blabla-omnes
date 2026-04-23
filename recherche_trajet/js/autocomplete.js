

function initAutocompleteStart() {
    var input = document.getElementById('autocomplete_start');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        var city = "";
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (addressType === "locality") {
                city = place.address_components[i].long_name;
                break;
            }
        }

        if (city) {
            console.log("City: " + city);
        } else {
            console.log("City not found in the selected place");
        }

        // Stocker la ville dans le champ caché du formulaire
        document.getElementById('city_start').value = city;

        // Soumettre le formulaire
        document.getElementById('locationForm').submit();
    });
}
function initAutocompleteEnd() {
    var input = document.getElementById('autocomplete_end');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        var city = "";
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (addressType === "locality") {
                city = place.address_components[i].long_name;
                break;
            }
        }

        if (city) {
            console.log("City: " + city);
        } else {
            console.log("City not found in the selected place");
        }

        // Stocker la ville dans le champ caché du formulaire
        document.getElementById('city_end').value = city;

        // Soumettre le formulaire
        document.getElementById('locationForm').submit();
    });
}

google.maps.event.addDomListener(window, 'load', initAutocompleteStart);
google.maps.event.addDomListener(window, 'load', initAutocompleteEnd);