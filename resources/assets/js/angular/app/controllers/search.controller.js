campsite.controllers.controller('SearchCtrl', function($scope, $rootScope, $http, $location, service, $window, $route, $timeout){
    var self = this;
    var campsiteinventoryurl = "/" + currentlanguage + "/campsite/offers";
    var campsitesearchurl = "/" + currentlanguage + "/campsite/search";
    var provincesurl = "/" + currentlanguage + "/provinces";
    var statesurl = "/" + currentlanguage + "/states";
    var searchOnProvinceUrl = '/' + currentlanguage + '/search-campsite/';
    var searchpage = '/' + currentlanguage + '/search-campsite';

    angular.element( document.querySelectorAll( '#belgiummap > path') ).click(
        function (event) {
            sessionStorage.provinceId = event.currentTarget.id;
            $http({
                method: "GET",
                url: searchOnProvinceUrl + sessionStorage.provinceId
            }).then(function success(response) {
                console.log(response);
                sessionStorage.searchresults = JSON.stringify(response);
                $window.location.href = searchpage;
            }, function error(response) {
                console.log(response);
            });
        }
    );


    // Events
    this.events = {

        changePage: function(url){
            self.handlers.getPagination(url);
        },
        getAllCampsites: function() {
            self.state.campsite_offers_loading = true;

            if (sessionStorage.searchresults)
            {
                if (sessionStorage.searchobject)
                {
                    sessionStorage.removeItem('searchobject');
                }
                var searchedprovinces = JSON.parse(sessionStorage.searchresults);
                self.state.campsite_offers = searchedprovinces.data.data;
                self.state.paginate_nexturl = searchedprovinces.data.next_page_url;
                self.state.paginate_previousurl = searchedprovinces.data.prev_page_url;

                self.state.number_of_cars = searchedprovinces.data.total;
                self.state.current_page = searchedprovinces.data.current_page;
                self.state.number_of_pages = searchedprovinces.data.last_page;
                self.state.searchObject.provinces = [searchedprovinces.data.data.province];
                var count = 0;
                var i;
                delete self.state.campsite_offers.province;
                for (i in self.state.campsite_offers) {
                    if (self.state.campsite_offers.hasOwnProperty(i)) {
                        count++;
                    }
                }
                if (count == 0)
                {
                    self.state.noresultsfound = true;
                } else {
                    self.state.noresultsfound = false;
                }
                self.state.campsite_offers_loading = false;
            } else {
                service.get(campsiteinventoryurl)
                    .then(function success(response) {
                        self.state.campsite_offers = response.data;
                        console.log(response.data);
                        self.state.paginate_nexturl = response.next_page_url;
                        self.state.paginate_previousurl = response.prev_page_url;

                        self.state.number_of_cars = response.total;
                        self.state.current_page = response.current_page;
                        self.state.number_of_pages = response.last_page;
                        self.state.campsite_offers_loading = false;
                    }, function error(response) {
                        console.log(response);
                    });
            }

            sessionStorage.removeItem('searchresults');
            sessionStorage.removeItem('provinceId');

        },

    };

    // Handlers
    this.handlers = {

        getAllProvinces: function () {
            service.get(provincesurl)
                .then(function success(response) {
                    self.state.provinces = response;
                }, function error(response) {
                    console.log(response);
                });
        },

        getAllStates: function () {
            service.get(statesurl)
                .then(function success(response) {
                    self.state.states = response;
                }, function error(response) {
                    console.log(response);
                });
        },

        search: function() {
            console.log(self.state.searchObject);
            if (!self.state.searchObject.provinces || self.state.searchObject.provinces.length == 0) {
                self.state.searchObject.provinces = self.state.provinces;
            }
            if (!self.state.searchObject.states ||self.state.searchObject.states.length == 0) {
                self.state.searchObject.states = self.state.states;
            }
            self.state.provinces_loading = true;
            self.state.states_loading = true;
            sessionStorage.searchobject = JSON.stringify(self.state.searchObject);
            self.state.searchObject.provinces = JSON.stringify(self.state.searchObject.provinces);
            self.state.searchObject.states = JSON.stringify(self.state.searchObject.states);
            $timeout( function(){
                service.get(campsitesearchurl, self.state.searchObject)
                    .then(function success(response) {
                        console.log(response);
                        self.state.campsite_offers = response;
                        if (response.length == 0)
                        {
                            self.state.noresultsfound = true;
                        } else {
                            self.state.noresultsfound = false;
                        }
                        self.state.campsite_offers_loading = false;
                        self.state.searchObject.provinces = JSON.parse(self.state.searchObject.provinces);
                        self.state.searchObject.states = JSON.parse(self.state.searchObject.states);
                        self.state.campsite_offers_loading = false;
                        self.state.provinces_loading = false;
                        self.state.states_loading = false;
                    }, function error(response) {
                        console.log(response);
                        self.state.searchObject.provinces = JSON.parse(self.state.searchObject.provinces);
                    });
            }, 10 );
        },

        getSearchobjectfromSession: function () {
            if (sessionStorage.getItem('searchobject'))
            {
                self.state.searchObject = JSON.parse(sessionStorage.searchobject);
                console.log(sessionStorage.searchobject);
                self.handlers.search();
            }
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

            self.events.getAllCampsites();
            sessionStorage.removeItem('searchobject');
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

                    self.state.number_of_campsites = response.total;
                    self.state.current_page = response.current_page;
                    self.state.number_of_pages = response.last_page;
                }, function error(response) {
                    console.log(response);
                });
            self.events.getAllCampsites();
        }

    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.getSearchobjectfromSession();
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
            }
        },

        language: currentlanguage,

        noresultsfound: false,
        searchAdvanced: false
    };
});
