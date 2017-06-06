campsite.controllers.controller('ReservationCtrl', function($scope, $rootScope, $location, service, $window, toastr, $injector){
    var self = this;
    var makereservationurl = '/en/make-reservation';

    // Events
    this.events = {
        nextDate: function(id) {
            angular.element( document.querySelector( '#' + id ) ).focus();
        },


        makeReservation: function(id) {
            console.log(self.state.reservation);
            var start_date = self.state.reservation.start_date;
            var end_date = self.state.reservation.end_date;
            self.state.reservation.campsite_id = id;
            self.state.datatosend.reservation = self.state.reservation;
            self.state.datatosend.reservation.start_date = self.handlers.makeDateFromString(start_date);
            self.state.datatosend.reservation.end_date = self.handlers.makeDateFromString(end_date);
            console.log(self.state.reservation);
            self.handlers.postDataToServer();
        }
    };

    // Handlers
    this.handlers = {
        postDataToServer: function () {
            console.log(self.state.datatosend);
            service.post(makereservationurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);
                    toastr.success('Success', 'Your reservation request was sent!');

                }, function errorCallback(response) {
                    console.log(response);
                    toastr.error('Error', 'Something went wrong!');
                });
        },

        makeDateFromString: function(value) {
            var from = value.split("-");
            var date = new Date(from[2], from[1] - 1, from[0]);
            return date;
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {

    });

    // Init
    this.state = {
        startdate: '',
        enddate: '',
        today: new Date(),

        reservation: {},
        datatosend: {}
    };


});
