'use strict';

angular
    .module('hicv.design')
    .directive('changeColor', changeColor);

function changeColor() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-change-layout/change-color.html',
        controller: 'changeColor',
        controllerAs: '$ctrl'
    };
}
