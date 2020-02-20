'use strict';

angular
    .module('hicv.design')
    .directive('templateProject', templateProject);

function templateProject() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-project/example-project.html';
            }
            return 'app/hicv/directives/template-project/template-project.html';
        },
        controller: 'TemplateProjectController',
        controllerAs: '$ctrl'
    };
}
