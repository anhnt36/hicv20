(function () {
    'use strict';

    angular
        .module('hicv.design')
        .service('ItemExperience', ItemExperience);

    /* @ngInject */
    function ItemExperience(DataModel, DatePeriodModel) {

        return ItemExperienceModel;

        function ItemExperienceModel(data) {

            var self = new DataModel({
                id: 0,
                priority: 0,
                key: 'experience',
                title: '',
                company: {
                    value: '',
                    display: true
                },
                link: {
                    value: '',
                    display: true
                },
                datePeriod: new DatePeriodModel,
                location: {
                    value: '',
                    display: true
                },
                shortSummary: {
                    value: '',
                    display: true
                },
                example: {
                    display: true,
                    data: [
                        '',
                    ]
                },
                selected: false
            }).pre(function (data) {
                data.datePeriod = new DatePeriodModel(data.datePeriod);
                return data;
            }).serialize(data);

            return self;
        }
    }

})();
