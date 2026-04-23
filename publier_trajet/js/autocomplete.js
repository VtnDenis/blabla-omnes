function initAutocomplete() {
    var input = document.getElementById('autocomplete');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.log("No details available for input: '" + place.name + "'");
            return;
        }

        var addressComponents = {
            street_number: '',
            route: '',
            locality: '',
            country: '',
            postal_code: ''
        };

        place.address_components.forEach(function(component) {
            var types = component.types;
            if (types.includes('street_number')) {
                addressComponents.street_number = component.long_name;
            }
            if (types.includes('route')) {
                addressComponents.route = component.long_name;
            }
            if (types.includes('locality')) {
                addressComponents.locality = component.long_name;
            }
            if (types.includes('country')) {
                addressComponents.country = component.long_name;
            }
            if (types.includes('postal_code')) {
                addressComponents.postal_code = component.long_name;
            }
        });

        // Séparer route en type et nom
        var route = addressComponents.route;
        var routeType = '';
        var routeName = '';

        // Liste des types de voie courants
        var routeTypes = ['rue', 'avenue', 'boulevard', 'place', 'impasse', 'chemin', 'route', 'allée', 'quai', 'voie'];

        // Séparer le type de voie du nom de voie
        routeTypes.forEach(function(type) {
            var regex = new RegExp(`^${type}\\b`, 'i');
            if (regex.test(route)) {
                routeType = type;
                routeName = route.replace(regex, '').trim();
            }
        });

        document.getElementById('street_number').value = addressComponents.street_number;
        document.getElementById('route_type').value = routeType;
        document.getElementById('route_name').value = routeName;
        document.getElementById('locality').value = addressComponents.locality;
        document.getElementById('country').value = addressComponents.country;
        document.getElementById('postal_code').value = addressComponents.postal_code;

        // Soumettre le formulaire
        document.getElementById('locationForm').submit();
    });
}

google.maps.event.addDomListener(window, 'load', initAutocomplete);