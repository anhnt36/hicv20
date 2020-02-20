'use strict';

angular
    .module('hicv.design')
    .controller('CheckFieldController', CheckFieldController);

/* @ngInject */
function CheckFieldController($scope) {
    var $ctrl = this;

    init();
    $ctrl.clickDisplayOption = function(field) {

        field.display = field.display ? false : true;
    };
    $ctrl.clickChangeStyleOption = function(field) {

        field.style = field.style == 1 ? 0 : 1;
    };

    function init() {
        if(!$ctrl.type) {
            $ctrl.tpType = 'text';
        }
    }
}
