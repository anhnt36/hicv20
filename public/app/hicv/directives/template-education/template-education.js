'use strict';


angular
    .module('hicv.design')
    .directive('templateEducation', templateEducation);

function templateEducation() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-education/example-education.html';
            }
            return 'app/hicv/directives/template-education/template-education.html';
        },
        controller: 'TemplateEducationController',
        controllerAs: '$ctrl'
    };
}
