'use strict';

angular
    .module('hicv.design')
    .controller('changeLayout', changeLayout);

/* @ngInject */
function changeLayout($scope, $rootScope, DesignService, layoutService, $timeout) {
    var $ctrl = this;
    $ctrl.layouts = layoutService.layouts;
    $ctrl.setLayout = function (layout) {

        if (layoutService.layouts[layout].locked || layout == DesignService.layout) {
            return false;
        }
        DesignService.changeLayout = true;
        DesignService.layout = layout;
        $rootScope.$broadcast('change-layout');
    };

    $ctrl.selected = function (layout) {
        return layout == DesignService.layout;
    };


    $ctrl.hide = function () {
        $timeout(function() {
            $scope.$parent.type = '';
        }, 10);
    };
}
