campsite.controllers.controller('OfferCtrl', function($scope, $rootScope, $location, service, $window, FileUploader, toastr, $injector){
    var self = this;
    var savecampsiteurl = '/en/campsite-offer/store';
    var imagesaveurl = '/en/campsite-offer/images/store';

    // Events
    this.events = {

        changeTemplate: function (index) {
            self.state.template = self.state.templates[index];
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
        },

        checkValid: function () {
            self.state.validationProvider.checkValid();
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

                    self.state.finish_message = "Success!";

                }, function errorCallback(response) {
                    console.log(response);
                    self.state.finish_message = "Something went wrong!";
                });
        },

        changeClass: function(e) {
            if (angular.element(e.target).hasClass('notchecked')) {
                console.log('gechecked');
                angular.element(e.target).removeClass('notchecked');
            } else {
                console.log('niet meer checked');
                angular.element(e.target).addClass('notchecked');
            }
        }
    };

    // Listeners
    $rootScope.$on('$locationChangeSuccess', function() {
        self.handlers.fillOfferTemplates();
    });

    // Init
    this.state = {
        templates: [],
        template: '',

        validationProvider: $injector.get('$validation'),

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
