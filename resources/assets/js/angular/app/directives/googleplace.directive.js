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
            notvalid: '=?'
        },
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
                componentRestrictions: {country: "be"}
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                var geoComponents = scope.gPlace.getPlace();
                console.log(geoComponents);
                if (geoComponents.geometry !== undefined) {

                    var latitude = geoComponents.geometry.location.lat();
                    var longitude = geoComponents.geometry.location.lng();
                    var street_number, street, zipcode, city, state, province;

                    var addressComponents = geoComponents.address_components;

                    addressComponents = addressComponents.filter(function (component) {
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
                                switch (component.short_name) {
                                    case "Walloon Region":
                                    case "Waals Gewest":
                                    case "Wallonie":
                                        state = 3;
                                        return true;
                                    case "Région Flamande":
                                    case "Flanders":
                                    case "Vlaanderen":
                                        state = 2;
                                        return true;
                                    case "Brussels Hoofdstedelijk Gewest":
                                    case "Brussels":
                                    case "Bruxelles":
                                    case "Brussel":
                                        province = 2;
                                        state = 1;
                                        return true;
                                    default:
                                        return false;
                                }
                                return true;
                            case "administrative_area_level_2": // province
                                switch (component.short_name) {
                                    case "AN":
                                        province = 1;
                                        return true;
                                    case "BX":
                                        province = 2;
                                        return true;
                                    case "HT":
                                        province = 3;
                                        return true;
                                    case "LI":
                                        province = 4;
                                        return true;
                                    case "LG":
                                        province = 5;
                                        return true;
                                    case "LX":
                                        province = 6;
                                        return true;
                                    case "NA":
                                        province = 7;
                                        return true;
                                    case "OV":
                                        province = 8;
                                        return true;
                                    case "VB":
                                        province = 9;
                                        return true;
                                    case "BW":
                                        province = 10;
                                        return true;
                                    case "WV":
                                        province = 11;
                                        return true;
                                    default:
                                        return false;
                                }
                                return true;
                            default:
                                return false;
                        }
                    }).map(function (obj) {
                        return obj.long_name;
                    });

                    //addressComponents.push(latitude, longitude);

                    scope.$apply(function () {
                        //scope.details = addressComponents; // array containing each location component
                        scope.latitude = latitude;
                        scope.longitude = longitude;
                        scope.number = street_number;
                        scope.street = street;
                        scope.zipcode = zipcode;
                        scope.city = city;
                        scope.state = state;
                        scope.province = province;
                        scope.notvalid = false;
                        model.$setViewValue(element.val());
                    });
                } else {
                    scope.$apply(function () {
                        scope.notvalid = true;
                        model.$setViewValue(element.val());
                    });
                }
            });
        }
    };
});
