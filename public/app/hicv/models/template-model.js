(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('TemplateModel', TemplateModel);

    /* @ngInject */
    function TemplateModel(DataModel) {

        return TemplateModel;

        function TemplateModel(data) {

            var self = new DataModel({
                name: '',
                page: 1,
                dragging: false
            })
            .serialize(data);
            return self;
        }
    }

})();
