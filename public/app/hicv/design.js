(function() {
    'use strict';

    angular
        .module('hicv.design',[
            'ui.router',
            'ngAnimate',
            'ngSanitize',
            'ui.bootstrap',
            'hicv.datamodel',
            'fps.hotkeys',
            'dndLists',
            'monospaced.elastic',
            'focus-if',
            'ui.router.modal',
            'ngFileUpload',
            'pascalprecht.translate',
            'ngFlash',
            'rzModule',
            'ngCookies',
            'ngResource',
            'naif.base64',
            'socialLogin'
        ])
        .factory('APIInterceptor', function(Auth, $cookies) {
            var self = this;
            self.request = function(config) {
                var token = $cookies.get('XSRF-TOKEN'),
                    access_token = token ? token : null;
                if (access_token) {
                    Auth.logined = true;
                    config.headers.authorization = access_token;
                }
                return config;
            };

            return self.request;
        })
        .config(designConfig);


    /* @ngInject */
    function designConfig($stateProvider, $urlRouterProvider, $httpProvider, socialProvider) {
        $urlRouterProvider.otherwise('/');

        $stateProvider.state('hicv.design', {
            url: '/edit/:param',
            templateUrl: 'app/hicv/design.html',
            controller: 'DesignController'
        });
        $httpProvider.interceptors.push('APIInterceptor');
        socialProvider.setGoogleKey("497149117926-ek6lt71agkb06kljdg5o4h8lrm5jcs81.apps.googleusercontent.com");
        socialProvider.setLinkedInKey("81djn09w6shn2w");
        socialProvider.setFbKey({appId: "1827980554141925", apiVersion: "v2.8"});
    }
})();