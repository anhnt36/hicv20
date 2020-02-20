'use strict';

angular
    .module('hicv.design')
    .directive('changeFont', changeFont);

function changeFont() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-change-layout/left-menu-change-font.html',
        controller: 'changeFont',
        controllerAs: '$ctrl'
    };
}
