campsite.controllers.controller('SearchCtrl', function($scope, $rootScope, $location, service, $window, $route, $timeout){
    var self = this;
    var campsiteinventoryurl = "/" + currentlanguage + "/campsite/offers";
    var campsitesearchurl = "/" + currentlanguage + "/campsite/search";
    var provincesurl = "/" + currentlanguage + "/provinces";
    var statesurl = "/" + currentlanguage + "/states";
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
            self.state.campsite_offers_loading = true;
            service.get(campsiteinventoryurl)
                .then(function success(response) {
                    console.log(response);
                    self.state.campsite_offers = response.data;
                    self.state.campsite_offers_loading = false;
                    self.state.paginate_nexturl = response.next_page_url;
                    self.state.paginate_previousurl = response.prev_page_url;

                    self.state.number_of_campsites = response.total;
                    self.state.number_of_all_campsites = response.total;
                    self.state.current_page = response.current_page;
                    self.state.number_of_pages = response.last_page;
                }, function error(response) {
                    console.log(response);
                });
        },

        getAllProvinces: function () {
            service.get(provincesurl)
                .then(function success(response) {
                    console.log(response);
                    self.state.provinces = response;
                }, function error(response) {
                    console.log(response);
                });
        },

        getAllStates: function () {
            service.get(statesurl)
                .then(function success(response) {
                    console.log(response);
                    self.state.states = response;
                }, function error(response) {
                    console.log(response);
                });
        },

        search: function() {
            console.log(self.state.searchObject);
            if (self.state.searchObject.provinces.length == 0) {
                self.state.searchObject.provinces = self.state.provinces;
            }
            if (self.state.searchObject.states.length == 0) {
                self.state.searchObject.states = self.state.states;
            }
            self.state.provinces_loading = true;
            self.state.searchObject.provinces = JSON.stringify(self.state.searchObject.provinces);
            self.state.searchObject.states = JSON.stringify(self.state.searchObject.states);
            $timeout( function(){
                service.get(campsitesearchurl, self.state.searchObject)
                    .then(function success(response) {
                        console.log(response);
                        self.state.campsite_offers = response.data;
                        if (response.total == 0)
                        {
                            self.state.noresultsfound = true;
                        } else {
                            self.state.noresultsfound = false;
                        }
                        self.state.campsite_offers_loading = false;
                        self.state.paginate_nexturl = response.next_page_url;
                        self.state.paginate_previousurl = response.prev_page_url;

                        self.state.number_of_campsites = response.total;
                        self.state.current_page = response.current_page;
                        self.state.number_of_pages = response.last_page;
                        self.state.searchObject.provinces = JSON.parse(self.state.searchObject.provinces);
                        self.state.searchObject.states = JSON.parse(self.state.searchObject.states);
                        self.state.campsite_offers_loading = false;
                        self.state.provinces_loading = false;
                    }, function error(response) {
                        console.log(response);
                        self.state.searchObject.provinces = JSON.parse(self.state.searchObject.provinces);
                    });
            }, 10 );
        },

        resetFilters: function() {
            self.state.searchObject = {
                capacity_slider: {
                    minValue: 10,
                    maxValue: 200,
                    options: {
                        floor: 0,
                        ceil: 250,
                        step: 1,
                        noSwitching: true
                    }
                },
                price_slider: {
                    minValue: 0,
                    maxValue: 30,
                    options: {
                        floor: 0,
                        ceil: 50,
                        step: 1,
                        noSwitching: true
                    }
                },
                facilities: {
                    building: false,
                    meadow: false
                }};
        },

        getPagination: function(url) {
            self.state.campsite_offers_loading = true;
            service.get(url)
                .then(function success(response) {
                    console.log(response);
                    self.state.campsite_offers = response.data;
                    self.state.campsite_offers_loading = false;
                    self.state.paginate_nexturl = response.next_page_url;
                    self.state.paginate_previousurl = response.prev_page_url;

                    self.state.current_page = response.current_page;
                    self.state.number_of_pages = response.last_page;
                }, function error(response) {
                    console.log(response);
                });
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.getAllCampsites();
        self.handlers.getAllProvinces();
        self.handlers.getAllStates();
    });

    // Init
    this.state = {
        campsite_offers: [],
        number_of_all_campsites: '',
        campsite_offers_loading: false,

        searchObject: {
            capacity_slider: {
                minValue: 10,
                maxValue: 200,
                options: {
                    floor: 0,
                    ceil: 250,
                    step: 1,
                    noSwitching: true
                }
            },
            price_slider: {
                minValue: 0,
                maxValue: 30,
                options: {
                    floor: 0,
                    ceil: 50,
                    step: 1,
                    noSwitching: true
                }
            }},

        language: currentlanguage,

        noresultsfound: false,
        searchAdvanced: false,

        paginate_nexturl: null,
        paginate_previousurl: null,

        current_page: null,
        number_of_pages: null
    };
});
