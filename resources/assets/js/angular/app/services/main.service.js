campsite.services.service('service', function($http, $q){
    this.fetch = function(method, url, data) {
        var _promise = $q.defer();
        $http({
            method: method,
            url: url,
            data: data,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            _promise.resolve(response.data);
        }, function(error) {
            _promise.reject(error);
        });

        return _promise.promise;
    };

    this.fetch2 = function(method, url, data) {
        var _promise = $q.defer();
        $http({
            method: method,
            url: url,
            params: data,
            data: data,
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(function(response) {
            _promise.resolve(response.data);
        }, function(error) {
            _promise.reject(error);
        });

        return _promise.promise;
    };

    this.get = function(url, data) {
        //var data = {};
        return this.fetch2('GET', url, data);
    };

    this.post = function(url, data) {
        return this.fetch('POST', url, data);
    };

    this.jsonp = function(url) {
        return this.fetch('JSONP', url);
    }
});
