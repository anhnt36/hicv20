'use strict';

angular
    .module('hicv.design')
    .controller('textExample', textExample);

/* @ngInject */
function textExample($scope, $rootScope, DesignService, layoutService) {
    var $ctrl = this;
    $ctrl.instruction = '';
    $ctrl.sectionInstruction = DesignService.selectedSection;
    init();
    function init() {
        $ctrl.instruction = DesignService.data[DesignService.selectedSection].getExample();
    }
    $scope.$on('change-section-instruction', function() {
        $ctrl.instruction = DesignService.data[DesignService.selectedSection].getExample();

    })
    $ctrl.hide = function () {
        $scope.$parent.type = '';
    };

}
