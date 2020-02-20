'use strict';

angular
    .module('hicv.design')
    .directive('templateDisplayField', templateDisplayField);

function templateDisplayField() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            fieldCheck : '=',
            data: '='
        },
        templateUrl: 'app/hicv/directives/template-display-field/template-display-field.html',
        controller: 'TemplateDisplayFieldController',
        controllerAs: '$ctrl'
    };
}
