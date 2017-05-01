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

campsite.controllers.controller('InventoryCtrl', ["$scope", "$rootScope", "$location", "service", "$window", "$route", "$timeout", function($scope, $rootScope, $location, service, $window, $route, $timeout){
  var self = this;
  var carinventoryurl = "/auto/offers";
  var carsearchurl = "/auto/search";
  var savequeryurl = "/auto/search/save";
  var updateemailurl = "/dealer/zoekopdrachten/update";


  // Events
  this.events = {

    changePage: function(url){
      self.handlers.getPagination(url);
    }

  };

  // Handlers
  this.handlers = {
    getAllOffers: function() {
      self.state.car_offers_loading = true;
      service.get(carinventoryurl)
      .then(function success(response) {
        console.log(response);
        self.state.car_offers = response.data;
        self.state.car_offers_loading = false;
        self.state.paginate_nexturl = response.next_page_url;
        self.state.paginate_previousurl = response.prev_page_url;

        self.state.number_of_cars = response.total;
        self.state.current_page = response.current_page;
        self.state.number_of_pages = response.last_page;
      }, function error(response) {
        console.log(response);
      });
    },

    search: function() {
      self.state.car_offers_loading = true;
      self.state.car_models_loading = true;
      self.state.searchObject.car_model = JSON.stringify(self.state.searchObject.car_model);
      console.log(self.state.searchObject);
      $timeout( function(){
        service.get(carsearchurl, self.state.searchObject)
        .then(function success(response) {
          $location.path('/inventaris');
          console.log(response);
          self.state.car_offers = response.data;
          self.state.car_offers_loading = false;
          self.state.paginate_nexturl = response.next_page_url;
          self.state.paginate_previousurl = response.prev_page_url;

          self.state.number_of_cars = response.total;
          self.state.current_page = response.current_page;
          self.state.number_of_pages = response.last_page;
          self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model);
          self.state.car_models_loading = false;
        }, function error(response) {
          console.log(response);
          self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model);
        });
      }, 10 );
    },
    saveSearchQuery: function() {
      self.state.searchObject.car_model = JSON.stringify(self.state.searchObject.car_model);
      service.post(savequeryurl, self.state.searchObject)
      .then(function success(response) {
        self.state.searchObject.searchquery_name = '';
        self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model)
      }, function error(response) {
        console.log(response);
        self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model)
      });

    },

    resetFilters: function() {
      self.state.searchObject = {};
    },

    getPagination: function(url) {
      self.state.car_offers_loading = true;
      service.get(url)
      .then(function success(response) {
        console.log(response);
        self.state.car_offers = response.data;
        self.state.car_offers_loading = false;
        self.state.paginate_nexturl = response.next_page_url;
        self.state.paginate_previousurl = response.prev_page_url;

        self.state.number_of_cars = response.total;
        self.state.current_page = response.current_page;
        self.state.number_of_pages = response.last_page;
      }, function error(response) {
        console.log(response);
      });
    },

    onChange: function(id) {
      self.state.emailid.id = id;
      service.post(updateemailurl, self.state.emailid)
      .then(function success(response) {
        console.log(response.needs_email);
      }, function error(response) {
        console.log(response);
      });
    }
  };

  // Listeners
  $rootScope.$on('$locationChangeSuccess', function() {
    //  self.handlers.getAllOffers();
  });

  // Init
  this.state = {
    car_offers: [],
    car_offers_loading: false,
    sortBy: 'end_date_bidding',  // set the default sort type
    sortReverse: true, // set the default sort order
    searchObject: {},

    emailid: {},
    searchqueries: {},

    searchAdvanced: false,

    paginate_nexturl: null,
    paginate_previousurl: null,

    number_of_cars: null,
    current_page: null,
    number_of_pages: null
  };
}]);
