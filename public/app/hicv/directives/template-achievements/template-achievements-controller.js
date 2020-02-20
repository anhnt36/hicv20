'use strict';

angular
    .module('hicv.design')
    .controller('TemplateAchievementsController', TemplateAchievementsController);

/* @ngInject */
function TemplateAchievementsController($scope, $rootScope, DesignService) {
    var $ctrl = this;
    $ctrl.cv = DesignService;
    $ctrl.fieldCheck = ['title', 'description', 'icon'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.displayPopoverTitle = false;
    $ctrl.styleDndPlaceholder = {
        width: DesignService.layout == 'double' ? '100%' : '49%',
        'min-height': '76px'
    };
    init();

    function init() {
        _.each($ctrl.data.items, function(item) {
            $ctrl.displayPopover.push(false);
        });
    }

    $scope.$watch(function() {
        return $('#' + $ctrl.data.id).height();
    }, function(newVal, oldVal) {
        // if(DesignService.changeLayout) {
        //     $ctrl.data.height = $('#' + $ctrl.data.id).height() + 20;
        $rootScope.$broadcast('change-height-layout-all');
        // }
    });



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

    $ctrl.clickSectionTitle = function clickSection($event, $index) {
        $rootScope.$broadcast('reset-popover');
        resetClickPopover();
        $rootScope.clickInputTitleSection($event);
        $ctrl.displayPopoverTitle = true;
    };
    $ctrl.clickSectionTitleOff = function clickSectionOff($event, $index) {
        $rootScope.clickOffInputTitleSection($event);
        $ctrl.displayPopoverTitle = false;
    };


    function resetClickPopover() {
        _.each($ctrl.displayPopover, function(item, $index) {
            $ctrl.displayPopover[$index] = false;
        });
        $ctrl.displayPopoverTitle = false;
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
