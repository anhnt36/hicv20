'use strict';

angular
    .module('hicv.design')
    .controller('changeFont', changeFont);

/* @ngInject */
function changeFont($scope, $rootScope, DesignService, layoutService, $timeout) {
    var $ctrl = this;

    $ctrl.setFont = function (font) {
        if (layoutService.fonts[font].locked || font == DesignService.font) {
            return false;
        }
        DesignService.font = font;
        $rootScope.$broadcast('change-font');
    };

    $ctrl.selected = function (font) {
        return font == DesignService.font;
    };

    $ctrl.fonts = layoutService.fonts;
    $ctrl.hide = function () {
        $timeout(function() {
            $scope.$parent.type = '';
        }, 10);
    };
}
