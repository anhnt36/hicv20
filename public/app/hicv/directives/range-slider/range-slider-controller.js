'use strict';

angular
    .module('hicv.design')
    .controller('RangeSliderController', RangeSliderController);

/* @ngInject */
function RangeSliderController($scope) {
    var $ctrl = this;
    $ctrl.level = $ctrl.data.value;
    $scope.$watch('$ctrl.level', function() {

        if($ctrl.level == 1) {
            $ctrl.experience.value = 'Người mới bắt đầu';
        } else if($ctrl.level == 2) {
            $ctrl.experience.value = 'Cơ bản';
        } else if($ctrl.level == 3) {
            $ctrl.experience.value = 'Nâng cao';
        } else if($ctrl.level == 4) {
            $ctrl.experience.value = 'Thành thạo';
        } else {
            $ctrl.experience.value = 'Chuyên gia';
        }
    })
}
