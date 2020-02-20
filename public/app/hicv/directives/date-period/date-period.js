'use strict';


angular
    .module('hicv.design')
    .directive('datePeriod', datePeriod);

function datePeriod() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '=',
        },
        templateUrl: 'app/hicv/directives/date-period/date-period.html',
        controller: 'DatePeriodController',
        controllerAs: '$ctrl'
    };
}
