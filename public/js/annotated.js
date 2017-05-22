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
    'ui.select'
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
            longitude: '=?'
        },
        link: function(scope, element, attrs, model) {
            var options = {
                types: [],
            };
            scope.gPlace = new google.maps.places.Autocomplete(element[0], options);

            google.maps.event.addListener(scope.gPlace, 'place_changed', function() {
                var geoComponents = scope.gPlace.getPlace();

                var latitude = geoComponents.geometry.location.lat();
                var longitude = geoComponents.geometry.location.lng();

                /*var addressComponents = geoComponents.address_components;

                addressComponents = addressComponents.filter(function(component){
                    switch (component.types[0]) {
                        case "locality": // city
                            return true;
                        case "administrative_area_level_1": // state
                            return true;
                        case "country": // country
                            return true;
                        default:
                            return false;
                    }
                }).map(function(obj) {
                    return obj.long_name;
                });

                addressComponents.push(latitude, longitude);*/

                scope.$apply(function() {
                    //scope.details = addressComponents; // array containing each location component
                    scope.latitude = latitude;
                    scope.longitude = longitude;
                    model.$setViewValue(element.val());
                });
            });
        }
    };
});

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

campsite.controllers.controller('OfferCtrl', ["$scope", "$rootScope", "$location", "service", "$window", "$route", "$timeout", function($scope, $rootScope, $location, service, $window, $route, $timeout){
    var self = this;
    var savecampsiteurl = '/en/campsite-offer/store';

    // Events
    this.events = {

        changeTemplate: function (index) {
            self.state.template = self.state.templates[index];
            /*var templateIndex = self.state.template.index;
             var previousTemplateIndex = templateIndex - 1;
             var nextTemplateIndex = templateIndex + 1;

             var currentEl = angular.element( document.querySelector( '#head_step' + templateIndex ) );
             var previousEl = angular.element( document.querySelector( '#head_step' + previousTemplateIndex) );
             var nextEl = angular.element( document.querySelector( '#head_step' + nextTemplateIndex) );

             for (i = 0; i < self.state.templates.length; i++) {
             if (i === templateIndex)
             {
             currentEl.addClass('step-now');
             previousEl.addClass('step-success');
             nextEl.removeClass('step-success');
             } else {
             previousEl.removeClass('step-now');
             nextEl.removeClass('step-now');
             }
             }*/
        },

        updateCampsiteData: function (index) {
            sessionStorage.campsitetosend = JSON.stringify(self.state.campsitetosend);
            self.state.datatosend.campsite = JSON.parse(sessionStorage.campsitetosend);
            console.log(self.state.datatosend.campsite);
            self.handlers.postDataToServer();
            //self.events.changeTemplate(index);
        },

    };

    // Handlers
    this.handlers = {
        fillOfferTemplates: function () {
            self.state.templates =[
                { name: 'state-1.html', url: 'assets/templates/offer/state-1.html', index: 0},
                { name: 'state-finish.html', url: 'assets/templates/offer/state-finish.html', index: 1}];
            self.state.template = self.state.templates[0];
        },

        postDataToServer: function () {
            console.log(self.state.datatosend);
            service.post(savecampsiteurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);

                    //self.events.changeTemplate(1);

                }, function errorCallback(response) {
                    console.log(response);
                });
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.fillOfferTemplates();
        //self.handlers.fillStateFromsessionStorage();
    });

    // Init
    this.state = {
        templates: [],
        template: '',

        campsitetosend: {},
        datatosend: {}
    };
}]);
