(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('ItemSkill', ItemSkill);

    /* @ngInject */
    function ItemSkill($q, DataModel, DatePeriodModel) {

        return ItemSkill;

        function ItemSkill(data) {

            var self = new DataModel({
                id: 0,
                key: 'skill',
                priority: 0,
                name: '',
                level:{
                    value: '',
                    display: true
                },
                selected: false
            }).serialize(data);

            return self;
        }
    }

})();
