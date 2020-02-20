(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('ItemAchievements', ItemAchievements);

    /* @ngInject */
    function ItemAchievements($q, DataModel,DatePeriodModel) {

        return ItemAchievements;

        function ItemAchievements(data) {

            var self = new DataModel({
                id: 0,
                priority: 0,
                key: 'achievements',
                title: {
                    value: '',
                    display: true
                },
                description: {
                    value: '',
                    display: true
                },
                icon: {
                    value: 'fa fa-hand-scissors-o',
                    display: true
                },
                selected: false
            })
                .serialize(data);

            return self;
        }
    }

})();
