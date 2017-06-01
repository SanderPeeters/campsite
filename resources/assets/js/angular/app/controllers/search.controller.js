campsite.controllers.controller('SearchCtrl', function($scope, $rootScope, $location, service, $window, $route, $timeout){
    var self = this;
    var campsiteinventoryurl = "/en/campsite/offers";
    var carsearchurl = "/en/campsite/search";
    //var savequeryurl = "/auto/search/save";
    //var updateemailurl = "/dealer/zoekopdrachten/update";


    // Events
    this.events = {

        changePage: function(url){
            self.handlers.getPagination(url);
        }

    };

    // Handlers
    this.handlers = {
        getAllCampsites: function() {
            self.state.car_offers_loading = true;
            service.get(campsiteinventoryurl)
                .then(function success(response) {
                    console.log(response);
                    self.state.campsite_offers = response.data;
                    self.state.campsite_offers_loading = false;

                    self.state.number_of_pages = response.last_page;
                }, function error(response) {
                    console.log(response);
                });
        },

        search: function() {
            console.log(self.state.searchObject);
            $timeout( function(){
                service.get(carsearchurl, self.state.searchObject)
                    .then(function success(response) {

                        console.log(response);
                        /*self.state.car_offers = response.data;
                        self.state.car_offers_loading = false;
                        self.state.paginate_nexturl = response.next_page_url;
                        self.state.paginate_previousurl = response.prev_page_url;

                        self.state.number_of_cars = response.total;
                        self.state.current_page = response.current_page;
                        self.state.number_of_pages = response.last_page;
                        self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model);
                        self.state.car_models_loading = false;*/
                    }, function error(response) {
                        console.log(response);
                        self.state.searchObject.car_model = JSON.parse(self.state.searchObject.car_model);
                    });
            }, 10 );
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
        self.handlers.getAllCampsites();
    });

    // Init
    this.state = {
        campsite_offers: [],
        campsite_offers_loading: false,
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
});
