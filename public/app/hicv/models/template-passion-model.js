(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplatePassionModel', TemplatePassionModel);

    /* @ngInject */
    function TemplatePassionModel(DataModel, TemplateModel, ItemPassion, DatePeriodModel) {

        return TemplatePassionModel;

        function TemplatePassionModel(data) {

            var self = new TemplateModel().extend({
                id: 'PassionSection-1',
                template: 'template-passion',
                key: 'passion',
                height: 144,
                position: 'left',
                title: 'Passion',
                icon: 'fa fa-cogs',
                priority: 1,
                priority_center: 9,
                items: [
                    new ItemPassion,
                    new ItemPassion
                ]
            }).pre(function (data) {
                _.each(data.items, function (item, $key) {
                    data.items[$key] = new ItemPassion(item);
                })
                return data;
            }).serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;

            function getExample() {
                return "Điền các thông tin về sở thích của bạn";
            }
            function addItem() {
                self.items.push(new ItemPassion().serialize());
            }
            function deleteItem(key) {
                self.items.splice(key, 1);
            }
            function getKey() {
                return  _.upperFirst(self.key);
            }
            return self;
        }

    }

})();
