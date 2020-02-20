'use strict';

angular
    .module('hicv.design')
    .controller('TemplateEducationController', TemplateEducationController);

/* @ngInject */
function TemplateEducationController($scope, $rootScope, DesignService, $timeout) {
    var $ctrl = this;
    var $root = $rootScope;
    $ctrl.fieldCheck = ['field', 'school', 'GPA'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.styleDndPlaceholder = {
        width: '100%',
        'min-height': '122px'
    };
    init();

    function init() {
        _.each($ctrl.data.items, function(item) {
            $ctrl.displayPopover.push(false);
        });
    }

    $ctrl.formatGPA = function(value) {

        if($ctrl.data.items[value].GPA.rate == "") {
            $ctrl.data.items[value].GPA.rate = '';
            return false;
        }
        if(_.parseInt($ctrl.data.items[value].GPA.rate) != 10) {
            $ctrl.data.items[value].GPA.rate = parseFloat($ctrl.data.items[value].GPA.rate).toFixed(2);
        }

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
        resetClickPopover();
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
