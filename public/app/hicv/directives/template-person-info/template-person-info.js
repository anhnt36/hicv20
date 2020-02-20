'use strict';

angular
    .module('hicv.design')
    .directive('templatePersonInfo', templatePersonInfo);

function templatePersonInfo() {
    return {
        restrict: 'EAC',
        scope: true,
        bindToController: {
            data: '=',
            tpClick: '&'
        },
        templateUrl: 'app/hicv/directives/template-person-info/template-person-info.html',
        controller: 'TemplatePersonInfoController',
        controllerAs: '$ctrl'
    };
}
