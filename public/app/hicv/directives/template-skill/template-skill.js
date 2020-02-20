'use strict';

angular
    .module('hicv.design')
    .directive('templateSkill', templateSkill);

function templateSkill() {
    return {
        restrict: 'AE',
        bindToController: {
            data: '=',
            isExample: '='
        },
        scope: {

        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-skill/example-skill.html';
            }
            return 'app/hicv/directives/template-skill/template-skill.html';
        },
        controller: 'TemplateSkillController',
        controllerAs: '$ctrl'
    };
}
