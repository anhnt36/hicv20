(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateLanguageModel', TemplateLanguageModel);

    /* @ngInject */
    function TemplateLanguageModel(DataModel, TemplateModel, ItemLanguage, DatePeriodModel) {

        return TemplateLanguageModel;

        function TemplateLanguageModel(data) {

            var self = new TemplateModel().extend({
                id: 'LanguageSection',
                template: 'template-language',
                key: 'languages',
                height: 238,
                position: 'right',
                title: 'Language',
                icon: 'fa fa-language',
                priority: 1,
                priority_center: 7,
                items: [
                    new ItemLanguage,
                    new ItemLanguage
                ]
            }).pre(function (data) {
                _.each(data.items, function (item, $key) {
                    data.items[$key] = new ItemLanguage(item);
                })
                return data;
            }).serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;

            function getExample() {
                return "Trình độ ngôn ngữ của bạn !";
            }
            function addItem() {
                self.items.push(new ItemLanguage().serialize());
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
