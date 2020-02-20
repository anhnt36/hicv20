'use strict';

angular
    .module('hicv.design')
    .controller('newSections', newSections);

/* @ngInject */
function newSections($scope, $rootScope, DesignService, $timeout) {
    var $ctrl = this;
    $ctrl.sections = _.sortBy(DesignService.all, function (self) {
        return self.title;
    });

    $ctrl.add = function (section) {
        if ($ctrl.added(section))
            return false;
        section.priority = _.parseInt(_.maxBy(_.filter(DesignService.data, ['position', 'right'], 'priority'))) + 1;
        section.priority_center = _.parseInt(_.maxBy(DesignService.data, 'priority_center')) + 1;
        DesignService.addSection(section);
        $rootScope.$broadcast('change-height-layout');
    };

    $ctrl.added = function (section) {
        return !!_.find(DesignService.data, function (_section) {
            return _section.template == section.template;
        });
    };

    $ctrl.hide = function () {
        $timeout(function() {
            $scope.$parent.type = '';
        }, 10);
    };
}
