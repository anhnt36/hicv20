'use strict';

angular
    .module('hicv.design')
    .directive('templatePopover', templatePopover);

function templatePopover() {
    return {
        restrict: 'E',
        scope: true,
        bindToController: {
            iconUpload: '@',
            iconCog: '@',
            iconTime: '@',
            iconAdd: '@',
            listIcon: '@',
            iconTrash: '@',
            fieldCheck: '=',
            data: '=',
            css: '@',
            key: '=',
            datePeriod: '=',
            templateData: '=',
            deleteSection: '@'
        },
        templateUrl: 'app/hicv/directives/template-popover/template-popover.html',
        controller: 'TemplatePopoverController',
        controllerAs: '$ctrl'
    };
}
