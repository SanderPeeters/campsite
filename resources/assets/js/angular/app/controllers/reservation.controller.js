campsite.controllers.controller('ReservationCtrl', function($scope, $rootScope, $location, service, toastr, $injector){
    var self = this;
    var movementsurl = '/en/movements';
    var savingurl = '/en/save-campsite';


    // Events
    this.events = {
        nextDate: function(id) {
            angular.element( document.querySelector( '#' + id ) ).focus();
        },

        statusSaveCampsite: function ($id) {
            self.state.datatosend.campsiteid = $id;
            self.state.datatosend.saved = self.state.saved;
            self.state.saved = !self.state.saved;
            service.post(savingurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);
                }, function errorCallback(response) {
                    console.log(response);
                });
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
