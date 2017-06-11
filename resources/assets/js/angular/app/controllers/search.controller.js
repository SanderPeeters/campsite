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
                sessionStorage.searchresults = JSON.stringify(response);
                $window.location.href = searchpage;
            }, function error(response) {
                console.log(response);
            });
        }
    );


    // Events
    this.events = {
        getAllCampsites: function() {
            self.state.campsite_offers_loading = true;

            if (sessionStorage.searchresults)
            {
                if (sessionStorage.searchobject)
                {
                    sessionStorage.removeItem('searchobject');
                }
                var searchedprovinces = JSON.parse(sessionStorage.searchresults);
                console.log(searchedprovinces);
                self.state.campsite_offers = searchedprovinces.data;
                self.state.searchObject.provinces = [searchedprovinces.data.province];

                delete self.state.campsite_offers.province;
                var count = self.state.handlers.getLengthOfObject(self.state.campsite_offers);
                if (count == 0)
                {
                    self.state.noresultsfound = true;
                } else {
                    self.state.noresultsfound = false;
                }
                console.log(count);
                self.state.number_of_campsites = count;
                self.state.campsite_offers_loading = false;
            } else {
                service.get(campsiteinventoryurl)
                    .then(function success(response) {
                        self.state.campsite_offers = response;
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
        getLengthOfObject: function($object) {
            var count = 0;
            var i;
            for (i in $object) {
                if ($object.hasOwnProperty(i)) {
                    count++;
                }
            }
            return count
        },

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
                        self.state.campsite_offers = response;
                        var count = self.handlers.getLengthOfObject(response);
                        if (count == 0)
                        {
                            self.state.noresultsfound = true;
                        } else {
                            self.state.noresultsfound = false;
                        }
                        self.state.number_of_campsites = count;
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
