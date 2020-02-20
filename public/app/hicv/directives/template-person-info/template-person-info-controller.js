'use strict';

angular
    .module('hicv.design')
    .controller('TemplatePersonInfoController', TemplatePersonInfoController);

/* @ngInject */
function TemplatePersonInfoController($scope, $rootScope, Upload, $timeout, DesignService, Flash) {
    var $ctrl = this;
    $ctrl.fieldCheck = ['say', 'phone', 'email', 'link', 'location', 'image', 'style', 'facebook', 'skype', 'linkedin'];
    $ctrl.displayPopover = false;
    $ctrl.visit = '';
    $ctrl.designScope = $scope.$parent.$parent;
    $ctrl.fileImage = '';
    $ctrl.checkPhone = function() {
        var checkRegx = /[^0-9]/g;
        if($ctrl.data.phone.value.length < 10 || $ctrl.data.phone.value.length > 11 || checkRegx.test($ctrl.data.phone.value)) {
            if($ctrl.data.phone.value != '' && !_.find(DesignService.errors, function(o) { return o.type == 'phone'; })) {
                Flash.create('danger', 'SĐT phải là số và lớn hơn 10 và nhỏ hơn 11 kí tự !');
            }
        }
    };
    $scope.$watchCollection('$ctrl.data', function() {
        $ctrl.data.height = $('#' + $ctrl.data.id).height() + 20;
    });

    $ctrl.clickSection = function clickSection($event) {
        $rootScope.$broadcast('reset-popover');
        DesignService.selectedSection = $ctrl.data.key;
        $rootScope.clickInput($event);
        $ctrl.displayPopover = true;

    };


    $scope.$on('reset-popover', function(event, args) {
        _.each($ctrl.displayPopover, function(value,$index) {
            $ctrl.displayPopover[$index] = false;
        });
    });
    $ctrl.clickSectionOff = function clickSectionOff($event) {
        $rootScope.clickOffInput($event);
        $ctrl.displayPopover = false;
    };

    $ctrl.uploadFiles = function(file, errFiles) {
        $ctrl.f = file;
        $ctrl.errFile = errFiles && errFiles[0];
        if (file) {
            file.upload = Upload.upload({
                url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0)
                    $ctrl.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 *
                    evt.loaded / evt.total));
            });
        }
    }

    $ctrl.change = function(e, reader, file, fileList, fileOjects, fileObj) {
        $ctrl.fileImage = "data:" + fileObj.filetype + ";base64," + fileObj.base64;
    }
    init();

    function init() {
        if($ctrl.data.image.value == '' || $ctrl.data.image.value == null) {
            $ctrl.fileImage = "/images/avatar-default.gif"
        } else if($ctrl.data.image.value != '' ) {
            $ctrl.fileImage = $ctrl.data.image.value;
        } else {
            $ctrl.fileImage = "data:" + $ctrl.data.image.value.filetype + ";base64," + $ctrl.data.image.value.base64;
        }
    }

    $ctrl.clickInputAvatar = function() {

        $timeout(function() {
            angular.element('#cv-upload-avatar').click();
        }, 10);

    }

}
