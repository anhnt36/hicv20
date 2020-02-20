(function() {
    'use strict';

    angular
        .module('hicv.api', ['ui.router'])
        .config(configureAPI)
        .factory('API', API);

    function configureAPI($httpProvider) {
        $httpProvider.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    }

    function API() {

    }
})();