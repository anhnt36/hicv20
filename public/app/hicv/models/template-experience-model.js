(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('TemplateExperienceModel', TemplateExperienceModel);

    /* @ngInject */
    function TemplateExperienceModel(DataModel, TemplateModel, ItemExperience, DatePeriodModel) {

        return TemplateExperienceModel;

        function TemplateExperienceModel(data) {

            var self = new TemplateModel().extend({
                id: 'ExperienceSection',
                key: 'experience',
                height: 378,
                position: 'left',
                template: 'template-experience',
                title: 'Experience',
                icon: 'icon-enhancv-02-fat',
                priority: 2,
                priority_center: 3,
                items : [
                    new ItemExperience,
                    new ItemExperience
                ]
            }).pre(function (data) {
                _.each(data.items, function (item, $key) {
                    data.items[$key] = new ItemExperience(item);
                });
                return data;
            }).serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;

            function getExample() {
                return "Điền các thông tin về kinh nghiệm học tập hoặc quá trình làm việc của bạn cho đến bây giờ!";
            }
            function addItem() {
                self.items.push(new ItemExperience().serialize());
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
