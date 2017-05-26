campsite.directives.directive('googleplace', function() {
    return {
        require: 'ngModel',
        scope: {
            ngModel: '=',
            latitude: '=?',
            longitude: '=?',
            number: '=?',
            street: '=?',
            city: '=?',
            state: '=?',
            province: '=?',
            zipcode: '=?',
            /*details: '=?'*/
        },
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: "be"}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                var geoComponents = scope.gPlace.getPlace();

                var latitude = geoComponents.geometry.location.lat();
                var longitude = geoComponents.geometry.location.lng();
                var street_number, street, zipcode, city, state, province;

                var addressComponents = geoComponents.address_components;

                addressComponents = addressComponents.filter(function(component){
                    switch (component.types[0]) {
                        case "street_number": // street number
                            street_number = component.long_name;
                            return true;
                        case "route": // street
                            street = component.long_name;
                            return true;
                        case "postal_code": // zipcode
                            zipcode = component.long_name;
                            return true;
                        case "locality": // city
                            city = component.long_name;
                            return true;
                        case "administrative_area_level_1": // state
                            state = component.long_name;
                            return true;
                        case "administrative_area_level_2": // province
                            province = component.long_name;
                            return true;
                        default:
                            return false;
                    }
                }).map(function(obj) {
                    return obj.long_name;
                });

                //addressComponents.push(latitude, longitude);

                scope.$apply(function() {
                    //scope.details = addressComponents; // array containing each location component
                    scope.latitude = latitude;
                    scope.longitude = longitude;
                    scope.number = street_number;
                    scope.street = street;
                    scope.zipcode = zipcode;
                    scope.city = city;
                    scope.state = state;
                    scope.province = province;
                    model.$setViewValue(element.val());
                });
            });
        }
    };
});
