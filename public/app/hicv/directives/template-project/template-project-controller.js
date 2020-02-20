'use strict';

angular
    .module('hicv.design')
    .controller('TemplateProjectController', TemplateProjectController);

/* @ngInject */
function TemplateProjectController($scope, $rootScope, DesignService) {
    var $ctrl = this;
    $ctrl.fieldCheck = ['location', 'shortSummaryProject', 'example'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.focus = false;
    $ctrl.styleDndPlaceholder = {
        width: '100%',
        'min-height': '101px'
    };
    init();

    function init() {
        _.each($ctrl.data.items, function(item) {
            $ctrl.displayPopover.push(false);
        });
    }


    $ctrl.keydown = function(event ,item, $index) {
        if(event.keyCode == 13) {
            $ctrl.focus = true;
            event.preventDefault();
            item.example.data.push('');
            return false;
        } else if(event.keyCode == 8) {
            if(!item.example.data[$index]) {
                item.example.data.splice($index, 1);
            }
            return false;
        }
    };

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

    function resetClickPopover() {
        _.each($ctrl.displayPopover, function(item, $index) {
            $ctrl.displayPopover[$index] = false;
        });
    }
    $scope.$on('reset-popover', function(event, args) {
        _.each($ctrl.displayPopover, function(value,$index) {
            $ctrl.displayPopover[$index] = false;
        });
    });

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
