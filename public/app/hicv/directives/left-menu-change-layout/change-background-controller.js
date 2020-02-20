'use strict';

angular
    .module('hicv.design')
    .controller('changeBackground', changeBackground);

/* @ngInject */
function changeBackground($scope, $rootScope, DesignService, layoutService, $timeout) {
    var $ctrl = this;
    $ctrl.backgrounds = layoutService.backgrounds;
    $ctrl.check = true;

    $ctrl.select = function (bg) {
        DesignService.background = bg;
        $rootScope.$broadcast('change-background');
    };

    $ctrl.selected = function(bg){
        return DesignService.background == bg;
    };

    $ctrl.hide = function () {
        $timeout(function() {
            $scope.$parent.type = '';
        }, 10);
    };
}
