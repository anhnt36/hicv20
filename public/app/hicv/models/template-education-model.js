(function() {
    'use strict';


    angular
        .module('hicv.design')
        .service('TemplateEducationModel', TemplateEducationModel);

    /* @ngInject */
    function TemplateEducationModel(DataModel, TemplateModel, ItemEducation, DatePeriodModel) {

        return TemplateEducationModel;

        function TemplateEducationModel(data) {

            var self = new TemplateModel().extend({
                id: 'EducationSection',
                height: 290,
                key: 'education',
                template: 'template-education',
                position: 'left',
                title: 'Education',
                icon: 'icon-81-free-graduation-cap',
                priority: 1,
                priority_center: 8,
                items: [
                    new ItemEducation,
                    new ItemEducation
                ]
            })
                .pre(function (data) {
                    _.each(data.items, function (item, $key) {
                        data.items[$key] = new ItemEducation(item);
                    })
                    return data;
                })
                .serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;

            function getExample() {
                return "Điền các thông tin về tình hình học tập của bạn từ hồi THPT!";
            }
            function addItem() {
                self.items.push(new ItemEducation().serialize());

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
