'use strict';

angular
    .module('hicv.design')
    .controller('ListIconController', ListIconController);

/* @ngInject */
function ListIconController($scope) {
    var $ctrl = this;
    $ctrl.allIcon = ["fa fa-user-plus","fa fa-user-secret", "fa fa-user-times","fa fa-users","fa fa-vcard",
        "fa fa-vcard-o","fa fa-video-camera","fa fa-volume-control-phone","fa fa-volume-down","fa fa-volume-off",
        "fa fa-volume-up","fa fa-warning","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-window-close","fa fa-window-close-o",
        "fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-wifi","fa fa-wrench"];
    init();
    $ctrl.changeIcon = changeIcon;
    function init() {

    }

    function changeIcon(icon) {
        $ctrl.data = icon;
    }
}
