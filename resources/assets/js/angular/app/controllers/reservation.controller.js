campsite.controllers.controller('ReservationCtrl', function($scope, $rootScope, $location, service, $window, toastr, $injector){
    var self = this;
    var movementsurl = '/en/movements';


    // Events
    this.events = {
        nextDate: function(id) {
            angular.element( document.querySelector( '#' + id ) ).focus();
        }
    };

    // Handlers
    this.handlers = {

        getAllMovements: function() {
            service.get(movementsurl).then (
                function successCallback(response) {
                    console.log(response);
                    self.state.movements = response;
                }, function errorCallback (response) {
                    console.log(response);
                });
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.getAllMovements();
    });

    // Init
    this.state = {
        startdate: '',
        enddate: '',
        today: new Date(),

        formerrors: {
            startdate: false,
            enddate: false
        },

        reservation: {},
        datatosend: {}
    };


});
