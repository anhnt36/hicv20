'use strict';

angular
    .module('hicv.design')
    .directive('newSections', newSections);

function newSections() {
    return {
        restrict: 'E',
        scope: {
            data: '='
        },
        bindToController: {
        },
        templateUrl: 'app/hicv/directives/left-menu-new-sections/left-menu-new-sections.html',
        controller: 'newSections',
        controllerAs: '$ctrl'
    };
}
