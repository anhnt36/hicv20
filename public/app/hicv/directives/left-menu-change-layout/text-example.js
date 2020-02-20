'use strict';

angular
    .module('hicv.design')
    .directive('textExample', textExample);

function textExample() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-change-layout/text-example.html',
        controller: 'textExample',
        controllerAs: '$ctrl'
    };
}
