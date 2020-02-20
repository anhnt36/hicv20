'use strict';

angular
    .module('hicv.design')
    .controller('TemplatePopoverController', TemplatePopoverController);

/* @ngInject */
function TemplatePopoverController($scope, $rootScope, DesignService, $uibModal) {
    var $ctrl = this;
    $ctrl.dynamicPopover = {
        TemplateUrl: 'app/hicv/directives/template-popover/template-field-setup.html',
        TemplateDate: 'app/hicv/directives/template-popover/template-date-period.html',
        TemplateIcon: 'app/hicv/directives/template-popover/template-list-icon.html'
    };

    $ctrl.addItem = addItem;
    $ctrl.deleteItem = deleteItem;
    $ctrl.openExampleSectionModal = openExampleSectionModal;
    $ctrl.cv = DesignService;
    function addItem() {
        $ctrl.templateData.addItem();
        $rootScope.$broadcast('change-data-cv-layout');
    }

    function deleteItem() {
        if($ctrl.deleteSection == "true") {
            delete DesignService.data[$ctrl.templateData.key];
        } else {
            $ctrl.templateData.deleteItem($ctrl.key);
        }
        $rootScope.$broadcast('change-data-cv-layout');
    }

    $scope.$on('click-date', function() {
        $timeout(function() {
            angular.element('#cv-datetime').triggerHandler('click');
        }, 500);

    })

    function openExampleSectionModal () {
        $uibModal.open({
            templateUrl: 'app/hicv/modals/example-section/example-section.html',
            controller: 'ExampleSectionController',
            size: 'lg',
            resolve: {
                designService: DesignService
            }
        });
    };
}
