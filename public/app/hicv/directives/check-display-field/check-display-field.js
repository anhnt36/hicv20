'use strict';

angular
    .module('hicv.design')
    .directive('checkField', CheckField);

function CheckField() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            title: '@',
            data: '=',
            tpClass: '@',
            tpType: '@'
        },
        templateUrl: 'app/hicv/directives/check-display-field/check-display-field.html',
        controller: 'CheckFieldController',
        controllerAs: '$ctrl'
    };
}
