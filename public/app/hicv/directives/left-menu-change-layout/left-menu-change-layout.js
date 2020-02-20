'use strict';

angular
    .module('hicv.design')
    .directive('changeLayout', changeLayout);

function changeLayout() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-change-layout/left-menu-change-layout.html',
        controller: 'changeLayout',
        controllerAs: '$ctrl'
    };
}
