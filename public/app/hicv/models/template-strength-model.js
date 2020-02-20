(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateStrengthModel', TemplateStrengthModel);

    /* @ngInject */
    function TemplateStrengthModel(DataModel, TemplateModel, ItemPassion, DatePeriodModel) {

        return TemplateStrengthModel;

        function TemplateStrengthModel(data) {

            var self = new TemplateModel().extend({
                id: 'TalentSection-0',
                template: 'template-strength',
                key: 'strength',
                height: 228,
                position: 'left',
                title: 'Strength',
                icon: 'fa fa-cogs',
                priority: 1,
                priority_center: 6,
                items: [
                    new ItemPassion({key: 'strength'}),
                    new ItemPassion({key: 'strength'})
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
                return "Điền các thông tin về điểm mạnh nổi bật của bạn!";
            }
            function addItem() {
                self.items.push(new ItemPassion({key: 'strength'}).serialize());
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
