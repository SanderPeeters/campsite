campsite.controllers.controller('ReservationCtrl', function($scope, $rootScope, $location, service, $window, toastr, $injector){
    var self = this;

    // Events
    this.events = {
        nextDate: function() {
            angular.element( document.querySelector( '#enddate' ) ).focus();
        }
    };

    // Handlers
    this.handlers = {

    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {

    });

    // Init
    this.state = {
        startdate: '',
        enddate: '',
        today: new Date(),
    };


});
