'use strict';

/**
 * @ngdoc overview
 * @description
 * # HICV application
 *
 */
angular
    .module('hicv.design')
    .directive('templateAchievements', templateAchievements);

function templateAchievements() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            data: '='
        },
        templateUrl: function(element, attrs) {
            if(attrs.isExample) {
                return 'app/hicv/directives/template-achievements/example-achievements.html';
            }
            return 'app/hicv/directives/template-achievements/template-achievements.html';
        },
        controller: 'TemplateAchievementsController',
        controllerAs: '$ctrl',

    };
}
