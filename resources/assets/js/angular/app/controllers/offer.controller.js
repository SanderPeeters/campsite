campsite.controllers.controller('OfferCtrl', function($scope, $rootScope, $location, service, $window, $route, $timeout){
    var self = this;
    var savecampsiteurl = '/en/campsite-offer/store';

    // Events
    this.events = {

        changeTemplate: function (index) {
            self.state.template = self.state.templates[index];
            /*var templateIndex = self.state.template.index;
             var previousTemplateIndex = templateIndex - 1;
             var nextTemplateIndex = templateIndex + 1;

             var currentEl = angular.element( document.querySelector( '#head_step' + templateIndex ) );
             var previousEl = angular.element( document.querySelector( '#head_step' + previousTemplateIndex) );
             var nextEl = angular.element( document.querySelector( '#head_step' + nextTemplateIndex) );

             for (i = 0; i < self.state.templates.length; i++) {
             if (i === templateIndex)
             {
             currentEl.addClass('step-now');
             previousEl.addClass('step-success');
             nextEl.removeClass('step-success');
             } else {
             previousEl.removeClass('step-now');
             nextEl.removeClass('step-now');
             }
             }*/
        },

        updateCampsiteData: function (index) {
            sessionStorage.campsitetosend = JSON.stringify(self.state.campsitetosend);
            self.state.datatosend.campsite = JSON.parse(sessionStorage.campsitetosend);
            console.log(self.state.datatosend.campsite);
            self.handlers.postDataToServer();
            //self.events.changeTemplate(index);
        },

    };

    // Handlers
    this.handlers = {
        fillOfferTemplates: function () {
            self.state.templates =[
                { name: 'state-1.html', url: 'assets/templates/offer/state-1.html', index: 0},
                { name: 'state-finish.html', url: 'assets/templates/offer/state-finish.html', index: 1}];
            self.state.template = self.state.templates[0];
        },

        postDataToServer: function () {
            console.log(self.state.datatosend);
            service.post(savecampsiteurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);

                    //self.events.changeTemplate(1);

                }, function errorCallback(response) {
                    console.log(response);
                });
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.fillOfferTemplates();
        //self.handlers.fillStateFromsessionStorage();
    });

    // Init
    this.state = {
        templates: [],
        template: '',

        campsitetosend: {},
        datatosend: {}
    };
});
