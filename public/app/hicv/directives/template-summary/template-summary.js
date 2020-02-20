'use strict';

angular
    .module('hicv.design')
    .directive('templateSummary', templateSummary);

function templateSummary() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-summary/example-summary.html';
            }
            return 'app/hicv/directives/template-summary/template-summary.html';
        },
        controller: 'TemplateSummaryController',
        controllerAs: '$ctrl'
    };
}
