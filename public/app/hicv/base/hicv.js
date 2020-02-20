(function() {
    'use strict';

    angular
        .module('hicv',[
            'ui.router',
            'hicv.design'
        ])
        .config(addPosState)
        .config(configureApp)
        .run(runApp);


    /* @ngInject */
    function addPosState($stateProvider) {
        $stateProvider.state('hicv', {
            abstract: true,
            views: {
                'hicv-header': {
                    templateUrl: 'app/hicv/base/layout/hicv-header.html'
                },
                'hicv-body': {
                    templateUrl: 'app/hicv/base/layout/hicv-body.html'
                }
            }
        });
    }
    /* @ngInject */
    function configureApp($urlRouterProvider) {
        $urlRouterProvider.otherwise('/');
    }
    function runApp($rootScope) {

    }
})();