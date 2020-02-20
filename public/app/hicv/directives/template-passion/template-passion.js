'use strict';


angular
    .module('hicv.design')
    .directive('templatePassion', templatePassion);

function templatePassion() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-passion/example-passion.html';
            }
            return 'app/hicv/directives/template-passion/template-passion.html';
        },
        controller: 'TemplatePassionController',
        controllerAs: '$ctrl'
    };
}
