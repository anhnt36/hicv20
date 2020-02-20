'use strict';

angular
    .module('hicv.design')
    .controller('TemplateSummaryController', TemplateSummaryController);

/* @ngInject */
function TemplateSummaryController($scope, $rootScope, DesignService) {
    var $ctrl = this;
    $ctrl.fieldCheck = ['level'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.designScope = $scope.$parent.$parent.$parent.$parent;
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
    $ctrl.keydown = function(event ,item) {
        if(event.keyCode == 13) {
            $ctrl.focus = true;
            event.preventDefault();
            item.example.data.push('');
            return false;
        }
    };



    // Drap and drop
    $ctrl.dragoverCallback = function(event, index, external, type) {
        $ctrl.logListEvent('dragged over', event, index, external, type);
        // Disallow dropping in the third row. Could also be done with dnd-disable-if.
        return index < 10;
    };

    $ctrl.dropCallback = function(event, index, item, external, type) {
        $ctrl.logListEvent('dropped at', event, index, external, type);
        // Return false here to cancel drop. Return true if you insert the item yourself.
        return item;
    };

    $ctrl.logEvent = function(message, event) {
        console.log(message, '(triggered by the following', event.type, 'event)');
        console.log(event);
    };

    $ctrl.logListEvent = function(action, event, index, external, type) {
        var message = external ? 'External ' : '';
        message += type + ' element is ' + action + ' position ' + index;
        $ctrl.logEvent(message, event);
    };
}
