(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('ItemEducation', ItemEducation);

    /* @ngInject */
    function ItemEducation($q, DataModel,DatePeriodModel) {

        return ItemEducation;

        function ItemEducation(data) {

            var self = new DataModel({
                id: 0,
                priority: 0,
                key: 'education',
                field: {
                    value: '',
                    display: true
                },
                school: {
                    value: '',
                    display: true
                },
                datePeriod: new DatePeriodModel,
                GPA: {
                    total: 10,
                    rate: 0,
                    display: true
                },
                selected: false
            })
            .serialize(data);

            return self;
        }
    }

})();
