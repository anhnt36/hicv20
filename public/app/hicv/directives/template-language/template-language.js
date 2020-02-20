'use strict';

angular
    .module('hicv.design')
    .directive('templateLanguage', templateLanguage);

function templateLanguage() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-language/example-language.html';
            }
            return 'app/hicv/directives/template-language/template-language.html';
        },
        controller: 'TemplateLanguageController',
        controllerAs: '$ctrl'
    };
}
