'use strict';

angular
    .module('hicv.design')
    .controller('DatePeriodController', DatePeriodController);

/* @ngInject */
function DatePeriodController($scope, DesignService) {
    var $ctrl = this;
    $ctrl.months = [1,2,3,4,5,6,7,8,9,10,11,12];
    $ctrl.years = [];
    $ctrl.clickOnGoing = clickOnGoing;
    $ctrl.checkDate = checkDate;

    init();

    function init() {

        var currentDate = new Date;
        currentDate = currentDate.getFullYear();
        for(var i = currentDate; i >= 1994; i--) {
            $ctrl.years.push(i);
        }
    }

    function clickOnGoing(event) {
        if($ctrl.data.onGoing == false) {
            $ctrl.data.onGoing = true;
        } else {
            $ctrl.data.onGoing = false;
        }
        $ctrl.checkDate();
    }

    function checkDate() {
        var d = new Date();
        if(_.parseInt($ctrl.data.yearFrom) > _.parseInt($ctrl.data.yearTo)
            || (_.parseInt($ctrl.data.yearFrom) == _.parseInt($ctrl.data.yearTo) && _.findIndex($ctrl.months, $ctrl.data.monthFrom) > _.findIndex($ctrl.months,$ctrl.data.monthTo))
            || ($ctrl.data.onGoing && _.parseInt($ctrl.data.yearFrom) <= _.parseInt(d.getYear())
            || ($ctrl.data.onGoing && _.parseInt($ctrl.data.yearTo) >= _.parseInt(d.getYear()))
        )) {
            if(!_.find(DesignService.errors, function(o) { return o.type == 'datetime'; })) {
                DesignService.setError({
                    type: 'datetime',
                    message: 'Thời gian bạn nhập không hợp lệ !'
                });
            }

        } else {
            _.remove(DesignService.errors, {
                type: 'datetime'
            });
        }
    }
}
