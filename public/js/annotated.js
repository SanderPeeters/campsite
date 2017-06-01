var dependencies = [
    'campsite.services',
    'campsite.directives',
    'campsite.controllers',

    'ngAnimate',
    'ngRoute',
    'ngSanitize',
    'angular.filter',
    'validation',
    'validation.rule',
    'angularFileUpload',
    '720kb.tooltips',
    'toastr',
    'angular.vertilize',
    'ui.select',
    'textAngularSetup',
    'textAngular'
];

var campsite = {
    app: angular.module('campsite', dependencies),
    controllers: angular.module('campsite.controllers', []),
    directives: angular.module('campsite.directives', []),
    services: angular.module('campsite.services', [])
};

campsite.app.config(["$locationProvider", "$interpolateProvider", "$sceDelegateProvider", "toastrConfig", function($locationProvider, $interpolateProvider, $sceDelegateProvider, toastrConfig) {
    var supports_history_api = function() {
        return !!(window.history && history.pushState);
    };

    $interpolateProvider.startSymbol('##');
    $interpolateProvider.endSymbol('##');
    if (supports_history_api()) {
        $locationProvider.html5Mode(true);
    } else {
        $locationProvider.html5Mode(false);
    }

    $sceDelegateProvider.resourceUrlWhitelist([
        'self',
        'https://www.carqueryapi.com/**'
    ]);

    angular.extend(toastrConfig, {
        allowHtml: false,
        closeButton: true,
        //closeHtml: '<button>&times;</button>',
        extendedTimeOut: 1000,
        iconClasses: {
            error: 'toast-error',
            info: 'toast-info',
            success: 'toast-success',
            warning: 'toast-warning'
        },
        messageClass: 'toast-message',
        onHidden: null,
        onShown: null,
        onTap: null,
        progressBar: true,
        tapToDismiss: true,
        timeOut: 5000,
        titleClass: 'toast-title',
        toastClass: 'toast',
        autoDismiss: false,
        containerId: 'toast-container',
        maxOpened: 3,
        newestOnTop: true,
        positionClass: 'toast-bottom-center',
        preventDuplicates: true,
        preventOpenDuplicates: true,
        target: 'body'
    });

}]);

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
                                state = component.long_name;
                                return true;
                            case "administrative_area_level_2": // province
                                province = component.long_name;
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

campsite.directives.directive('ngThumb', ["$window", function($window) {
    var helper = {
        support: !!($window.FileReader && $window.CanvasRenderingContext2D),
        isFile: function(item) {
            return angular.isObject(item) && item instanceof $window.File;
        },
        isImage: function(file) {
            var type =  '|' + file.type.slice(file.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    };

    return {
        restrict: 'A',
        template: '<canvas/>',
        link: function(scope, element, attributes) {
            if (!helper.support) return;

            var params = scope.$eval(attributes.ngThumb);

            if (!helper.isFile(params.file)) return;
            if (!helper.isImage(params.file)) return;

            var canvas = element.find('canvas');
            var reader = new FileReader();

            reader.onload = onLoadFile;
            reader.readAsDataURL(params.file);

            function onLoadFile(event) {
                var img = new Image();
                img.onload = onLoadImage;
                img.src = event.target.result;
            }

            function onLoadImage() {
                var width = params.width || this.width / this.height * params.height;
                var height = params.height || this.height / this.width * params.width;
                canvas.attr({ width: width, height: height });
                canvas[0].getContext('2d').drawImage(this, 0, 0, width, height);
            }
        }
    };
}]);

campsite.directives.directive('pwCheck', function() {
  return {
    require: 'ngModel',
    link: function (scope, elem, attrs, ctrl) {
      var firstPassword = '#' + attrs.pwCheck;
      elem.add(firstPassword).on('keyup', function () {
        scope.$apply(function () {
          var v = elem.val()===$(firstPassword).val();
          ctrl.$setValidity('pwmatch', v);
        });
      });
    }
  }
});

campsite.services.service('service', ["$http", "$q", function($http, $q){
    this.fetch = function(method, url, data) {
        var _promise = $q.defer();
        $http({
            method: method,
            url: url,
            data: data,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            _promise.resolve(response.data);
        }, function(error) {
            _promise.reject(error);
        });

        return _promise.promise;
    };

    this.fetch2 = function(method, url, data) {
        var _promise = $q.defer();
        $http({
            method: method,
            url: url,
            params: data,
            data: data,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            _promise.resolve(response.data);
        }, function(error) {
            _promise.reject(error);
        });

        return _promise.promise;
    };

    this.get = function(url, data) {
        //var data = {};
        return this.fetch2('GET', url, data);
    };

    this.post = function(url, data) {
        return this.fetch('POST', url, data);
    };

    this.jsonp = function(url) {
        return this.fetch('JSONP', url);
    }
}]);

campsite.controllers.controller('OfferCtrl', ["$scope", "$rootScope", "$location", "service", "$window", "FileUploader", "toastr", "$injector", function($scope, $rootScope, $location, service, $window, FileUploader, toastr, $injector){
    var self = this;
    var savecampsiteurl = '/en/campsite-offer/store';
    var imagesaveurl = '/en/campsite-offer/images/store';

    // Events
    this.events = {

        changeTemplate: function (index) {
            self.state.template = self.state.templates[index];
        },

        updateCampsiteData: function (index) {

            sessionStorage.campsitetosend = JSON.stringify(self.state.campsitetosend);
            sessionStorage.imagestosend = JSON.stringify(self.state.imagestosend);
            sessionStorage.buildings = JSON.stringify(self.state.buildings);
            sessionStorage.meadows = JSON.stringify(self.state.meadows);

            if (index == 3)
            {
                self.events.storeInfo();
            }
            self.events.changeTemplate(index);
        },

        storeInfo: function () {
            self.state.datatosend.campsite = JSON.parse(sessionStorage.campsitetosend);
            self.state.datatosend.images = JSON.parse(sessionStorage.imagestosend);
            self.state.datatosend.buildings = JSON.parse(sessionStorage.buildings);
            self.state.datatosend.meadows = JSON.parse(sessionStorage.meadows);
            console.log(self.state.datatosend);
            self.handlers.postDataToServer();
        },

        addNewBuilding: function () {
            var newItemNo = self.state.buildings.length + 1;
            self.state.buildings.push({'index': newItemNo});
        },

        addNewMeadow: function () {
            var newItemNo = self.state.meadows.length + 1;
            self.state.meadows.push({'index': newItemNo});
        },

        removeBuilding: function (index) {
            // remove the row specified in index
            self.state.buildings.splice(index, 1);
        },

        removeMeadow: function (index) {
            // remove the row specified in index
            self.state.meadows.splice(index, 1);
        },

        checkValid: function () {
            self.state.validationProvider.checkValid();
        }

    };

    // Handlers
    this.handlers = {
        fillOfferTemplates: function () {
            self.state.templates =[
                { name: 'state-1.html', url: 'assets/templates/offer/state-1.html', index: 0},
                { name: 'state-2.html', url: 'assets/templates/offer/state-2.html', index: 1},
                { name: 'state-3.html', url: 'assets/templates/offer/state-3.html', index: 2},
                { name: 'state-finish.html', url: 'assets/templates/offer/state-finish.html', index: 4}];
            self.state.template = self.state.templates[0];
        },

        postDataToServer: function () {
            console.log(self.state.datatosend);
            service.post(savecampsiteurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);
                    sessionStorage.removeItem("campsitetosend");
                    sessionStorage.removeItem("imagestosend");
                    sessionStorage.removeItem("buildings");
                    sessionStorage.removeItem("meadows");

                    self.events.changeTemplate(4);

                    self.state.finish_message = "Success!";

                }, function errorCallback(response) {
                    console.log(response);
                    self.state.finish_message = "Something went wrong!";
                });
        },

        changeClass: function(e) {
            if (angular.element(e.target).hasClass('notchecked')) {
                console.log('gechecked');
                angular.element(e.target).removeClass('notchecked');
            } else {
                console.log('niet meer checked');
                angular.element(e.target).addClass('notchecked');
            }
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.fillOfferTemplates();
    });

    // Init
    this.state = {
        templates: [],
        template: '',

        validationProvider: $injector.get('$validation'),

        campsitetosend: {},
        imagestosend: [],
        datatosend: {},
        buildings: [],
        meadows: [],

        finish_message: '',

        csrf_token: laravel_csrf,

        imageuploader: new FileUploader({
            url: imagesaveurl,
            filters: [{
                name: 'sizeSmallerThan',
                // Image must be smaller than 10 mb +-
                fn: function(item) {
                    if(item.size < 10000000){
                        return true;
                    }
                    else{
                        toastr.warning('Images must be smaller than 10MB!', 'Attention');
                    }
                }
            },
                {
                    name: 'isImage',
                    // file must be of type image
                    fn: function(item) {
                        if(item.type = 'image/*'){
                            console.log(item);
                            return true;
                        }
                        else{
                            console.log(item);
                            toastr.warning('File has to be an image!', 'Attention');
                        }
                    }
                }]
        })
    };

    self.state.imageuploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', headers);
        if(status == 200 && response.identifier){
            console.log(response);
            self.state.imagestosend.push(response.identifier);
        }
        else{
            if(response.error.imagetosave){
                toastr.error(response.error.imagetosave[0], 'Error');
            }
            else{
                toastr.error('Something went wrong during the upload of this picture!', 'Error');
            }
            //console.log(response.error);
        }
        //console.log(self.state.imagestosend);
    };
}]);
