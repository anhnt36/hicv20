'use strict';

angular
    .module('hicv.design')
    .directive('text', text);

function text() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            css: '@',
            data: '=',
            icon: '@',
            placeHolder: '@',
            maxLength: '@',
            spellCheck: '@',
            rows: '@',
            autoComplete: '@',
            tpStyle: '@',
        },
        templateUrl: 'app/hicv/directives/text/text.html',
        controller: 'TextController',
        controllerAs: '$ctrl'
    };
}
