(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateSummaryModel', TemplateSummaryModel);

    /* @ngInject */
    function TemplateSummaryModel(DataModel, TemplateModel, DatePeriodModel) {

        return TemplateSummaryModel;

        function TemplateSummaryModel(data) {

            var self = new TemplateModel().extend({
                    id: 'SummarySection-0',
                    template: 'template-summary',
                    key: 'summary',
                    height: 144,
                    position: 'left',
                    title: 'Summary',
                    icon: 'fa fa-cogs',
                    priority: 1,
                    priority_center: 1,
                    value: ''
                })
                .serialize(data);
            self.getExample = getExample;

            function getExample() {
                return "Tóm tắt về bạn!";
            }
            return self;
        }

    }

})();
