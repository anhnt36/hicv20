(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('ItemLanguage', ItemLanguage);

    /* @ngInject */
    function ItemLanguage($q, DataModel,DatePeriodModel) {

        return ItemLanguage;

        function ItemLanguage(data) {

            var self = new DataModel({
                id: 0,
                priority: 0,
                key: 'languages',
                language: '',
                proficiency: {
                    value: 'Người mới bắt đầu',
                    display: true
                },
                level: {
                    value: 4,
                    display: true
                },
                sliderStyle: '',
                selected: false
            })
            .serialize(data);

            return self;
        }
    }

})();
