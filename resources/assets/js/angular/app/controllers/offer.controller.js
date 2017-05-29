campsite.controllers.controller('OfferCtrl', function($scope, $rootScope, $location, service, $window, FileUploader, toastr){
    var self = this;
    var savecampsiteurl = '/en/campsite-offer/store';
    var imagesaveurl = '/en/campsite-offer/images/store';

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
            sessionStorage.imagestosend = JSON.stringify(self.state.imagestosend);
            sessionStorage.buildings = JSON.stringify(self.state.buildings);
            sessionStorage.meadows = JSON.stringify(self.state.meadows);

            if (index == 3)
            {
                self.events.storeInfo();
            }
            self.events.changeTemplate(index);
        },

        storeInfo: function () {
            self.state.datatosend.campsite = JSON.parse(sessionStorage.campsitetosend);
            self.state.datatosend.images = JSON.parse(sessionStorage.imagestosend);
            self.state.datatosend.buildings = JSON.parse(sessionStorage.buildings);
            self.state.datatosend.meadows = JSON.parse(sessionStorage.meadows);
            console.log(self.state.datatosend);
            self.handlers.postDataToServer();
        },

        addNewBuilding: function () {
            var newItemNo = self.state.buildings.length + 1;
            self.state.buildings.push({'index': newItemNo});
        },

        addNewMeadow: function () {
            var newItemNo = self.state.meadows.length + 1;
            self.state.meadows.push({'index': newItemNo});
        },

        removeBuilding: function (index) {
            // remove the row specified in index
            self.state.buildings.splice(index, 1);
        },

        removeMeadow: function (index) {
            // remove the row specified in index
            self.state.meadows.splice(index, 1);
        }

    };

    // Handlers
    this.handlers = {
        fillOfferTemplates: function () {
            self.state.templates =[
                { name: 'state-1.html', url: 'assets/templates/offer/state-1.html', index: 0},
                { name: 'state-2.html', url: 'assets/templates/offer/state-2.html', index: 1},
                { name: 'state-3.html', url: 'assets/templates/offer/state-3.html', index: 2},
                { name: 'state-finish.html', url: 'assets/templates/offer/state-finish.html', index: 4}];
            self.state.template = self.state.templates[0];
        },

        postDataToServer: function () {
            console.log(self.state.datatosend);
            service.post(savecampsiteurl, self.state.datatosend).then (
                function successCallback(response) {
                    console.log(response);
                    sessionStorage.removeItem("campsitetosend");
                    sessionStorage.removeItem("imagestosend");
                    sessionStorage.removeItem("buildings");
                    sessionStorage.removeItem("meadows");

                    self.events.changeTemplate(4);

                    self.state.finish_message = "<h1>Success!</h1>";

                }, function errorCallback(response) {
                    console.log(response);
                    self.state.finish_message = "<h1>Something went wrong!</h1>";
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
        imagestosend: [],
        datatosend: {},
        buildings: [],
        meadows: [],

        finish_message: '',

        csrf_token: laravel_csrf,

        imageuploader: new FileUploader({
            url: imagesaveurl,
            filters: [{
                name: 'sizeSmallerThan',
                // Image must be smaller than 10 mb +-
                fn: function(item) {
                    if(item.size < 10000000){
                        return true;
                    }
                    else{
                        toastr.warning('Images must be smaller than 10MB!', 'Attention');
                    }
                }
            },
                {
                    name: 'isImage',
                    // file must be of type image
                    fn: function(item) {
                        if(item.type = 'image/*'){
                            console.log(item);
                            return true;
                        }
                        else{
                            console.log(item);
                            toastr.warning('File has to be an image!', 'Attention');
                        }
                    }
                }]
        })
    };

    self.state.imageuploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', headers);
        if(status == 200 && response.identifier){
            console.log(response);
            self.state.imagestosend.push(response.identifier);
        }
        else{
            if(response.error.imagetosave){
                toastr.error(response.error.imagetosave[0], 'Error');
            }
            else{
                toastr.error('Something went wrong during the upload of this picture!', 'Error');
            }
            //console.log(response.error);
        }
        //console.log(self.state.imagestosend);
    };
});
