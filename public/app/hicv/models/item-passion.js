(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('ItemPassion', ItemPassion);

    /* @ngInject */
    function ItemPassion($q, DataModel,DatePeriodModel) {

        return ItemPassion;

        function ItemPassion(data) {

            var self = new DataModel({
                id: 0,
                priority: 0,
                key: 'passion',
                language: '',
                icon: {
                    value: 'fa fa-hand-scissors-o',
                    display: true
                },
                description: {
                    value: '',
                    display: false
                },
                name: '',
                selected: false
            })
            .serialize(data);

            return self;
        }
    }

})();
