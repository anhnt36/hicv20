'use strict';

angular
    .module('hicv.design')
    .controller('changeColor', changeColor);

/* @ngInject */
function changeColor($scope, $rootScope, DesignService, layoutService, $timeout) {
    var $ctrl = this;
    $ctrl.colors = layoutService.colors;

    $ctrl.select = function (color) {
        DesignService.color = color;
        $rootScope.$broadcast('change-color');
    };

    $ctrl.selected = function(color){
        return DesignService.color == color;
    };

    $ctrl.hide = function () {
        $timeout(function() {
            $scope.$parent.type = '';
        }, 10);
    };

}
