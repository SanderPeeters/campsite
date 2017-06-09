campsite.controllers.controller('MapCtrl', function($scope, $rootScope, $location, service, $window, toastr, $injector){
    var searchOnProvinceUrl = '/en/search-campsite/';

    angular.element( document.querySelectorAll( '#belgiummap > path') ).click(
        function (event) {
            $window.location.href = searchOnProvinceUrl + event.currentTarget.id;
        }
    );

    this.state = {

    };

});
