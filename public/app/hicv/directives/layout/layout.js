'use strict';

angular
    .module('hicv.design')
    .directive('layout', layout);

function layout() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/layout/layout.html',
        controller: 'layout',
        controllerAs: '$ctrl'
    };
}
