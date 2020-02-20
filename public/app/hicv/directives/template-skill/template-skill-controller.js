'use strict';

angular
    .module('hicv.design')
    .controller('TemplateSkillController', TemplateSkillController);

/* @ngInject */
function TemplateSkillController($scope, $rootScope, DesignService, layoutService) {
    var $ctrl = this;
    $ctrl.optionSlider = {
        floor: 0,
        ceil: 5,
        showSelectionBar: true,
        getSelectionBarColor: function () {
            return layoutService.colors[DesignService.color].applyHead;
        },
        getPointerColor: function () {
            return layoutService.colors[DesignService.color].applyHead;
        },
        getTickColor: function () {
            return layoutService.colors[DesignService.color].applyHead;
        },
        selectionBarGradient:function () {
            return layoutService.colors[DesignService.color].applyHead;
        },

    };
    $ctrl.styleDndPlaceholder = {
        width: DesignService.layout == 'double' ? '49%' : '32%',
        'min-height': '90px'
    };

    $ctrl.fieldCheck = ['levelSkill'];
    $ctrl.displayPopover = [];
    $ctrl.visit = '';
    $ctrl.check = false;
    $ctrl.designScope = $scope.$parent.$parent.$parent.$parent;
    init();
    $ctrl.options2Css = {
        from: 1,
        to: 100,
        floor: true,
        step: 1,
        dimension: " km",
        vertical: false,
        css: {
            background: {"background-color": "silver"},
            before: {"background-color": "purple"},
            default: {"background-color": "white"},
            after: {"background-color": "green"},
            pointer: {"background-color": "red"}
        },
        callback: function(value, elt) {
            console.log(value);
        }
    };
    function init() {
        _.each($ctrl.data.items, function(item) {
            $ctrl.displayPopover.push(false);
        });
        $ctrl.check = true;
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
