'use strict';

/**
 * @ngdoc overview
 * @description
 * # HICV application
 *
 */
angular
    .module('hicv.design')
    .directive('rangeSlider', rangeSlider);

function rangeSlider() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            type: '@',
            data: '=',
            experience: '='
        },
        templateUrl: 'app/hicv/directives/range-slider/range-slider.html',
        controller: 'RangeSliderController',
        controllerAs: '$ctrl'
    };
}
