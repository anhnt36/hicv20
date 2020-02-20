'use strict';


angular
    .module('hicv.design')
    .directive('listIcon', listIcon);

function listIcon() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: 'app/hicv/directives/list-icon/list-icon.html',
        controller: 'ListIconController',
        controllerAs: '$ctrl'
    };
}
