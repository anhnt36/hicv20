'use strict';

angular
    .module('hicv.design')
    .directive('changeBackground', changeBackground);

function changeBackground() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-change-layout/change-background.html',
        controller: 'changeBackground',
        controllerAs: '$ctrl'
    };
}
