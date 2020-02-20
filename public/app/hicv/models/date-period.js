(function() {
    'use strict';

    angular
        .module('hicv.design')
        .factory('DatePeriodModel', DatePeriodModel);

    /* @ngInject */
    function DatePeriodModel(DataModel) {

        return DatePeriodModel;

        function DatePeriodModel(data) {

            var self = new DataModel({
                monthFrom: '',
                yearFrom: '',
                monthTo: '',
                yearTo: '',
                onGoing: true,
                display: true
            })
            .serialize(data);


            return self;
        }
    }

})();
