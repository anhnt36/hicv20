'use strict';


angular
    .module('hicv.design')
    .directive('templateStrength', templateStrength);

function templateStrength() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-strength/example-strength.html';
            }
            return 'app/hicv/directives/template-strength/template-strength.html';
        },
        controller: 'TemplateStrengthController',
        controllerAs: '$ctrl'
    };
}
