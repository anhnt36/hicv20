'use strict';

angular
    .module('hicv.design')
    .directive('templateExperience', templateExperience);

function templateExperience() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-experience/example-experience.html';
            }
            return 'app/hicv/directives/template-experience/template-experience.html';
        },
        controller: 'TemplateExperienceController',
        controllerAs: '$ctrl'

    };
}
