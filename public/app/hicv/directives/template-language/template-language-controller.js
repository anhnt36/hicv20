'use strict';

angular
    .module('hicv.design')
    .controller('TemplateLanguageController', TemplateLanguageController);

/* @ngInject */
function TemplateLanguageController($scope, $rootScope, DesignService) {
    var $ctrl = this;
    var $root = $rootScope;
    $ctrl.fieldCheck = ['proficiency', 'level'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.designScope = $scope.$parent.$parent.$parent.$parent;
    $ctrl.styleDndPlaceholder = {
        width: DesignService.layout == 'double' ? '49%' : '32%',
        'min-height': '75px'
    };
    init();

    function init() {
        _.each($ctrl.data.items, function(item) {
            $ctrl.displayPopover.push(false);
        });
    }

    $ctrl.clickSection = function clickSection($event, $index) {
        $rootScope.$broadcast('reset-popover');
        resetClickPopover();
        DesignService.selectedSection = $ctrl.data.key;
        $rootScope.clickInputItemSection($event);
        $ctrl.displayPopover[$index] = true;
    };
    $ctrl.clickSectionOff = function clickSectionOff($event, $index) {
        $rootScope.clickOffInputItemSection($event);
        $ctrl.displayPopover[$index] = false;
    };
    $scope.$on('reset-popover', function(event, args) {
        _.each($ctrl.displayPopover, function(value,$index) {
            $ctrl.displayPopover[$index] = false;
        });
    });
    function resetClickPopover() {
        _.each($ctrl.displayPopover, function(item, $index) {
            $ctrl.displayPopover[$index] = false;
        });
    }

    // Drap and drop
    $ctrl.dragoverCallback = function(event, index, external, type) {
        return index < 10;
    };

    $ctrl.dropCallback = function(event, index, item, external, type) {
        item.selected = false;
        return item;
    };

    $ctrl.logListEvent = function(action, event, index, external, type) {};
    $ctrl.getSelectedItemsIncluding = function(list, item) {
        item.selected = true;
        return item;
    };

    $ctrl.onDragstart = function(list, event) {
        list.dragging = true;
    };
}
