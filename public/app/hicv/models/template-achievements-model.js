(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateAchievementsModel', TemplateAchievementsModel);

    /* @ngInject */
    function TemplateAchievementsModel(DataModel, TemplateModel, ItemAchievements, DatePeriodModel) {

        return TemplateAchievementsModel;

        function TemplateAchievementsModel(data) {

            var self = new TemplateModel().extend({
                id: 'AchievementSection',
                template: 'template-achievements',
                key: 'achievements',
                position: 'right',
                height: 240,
                title: 'Achievements',
                icon: 'icon-23-free-star-two',
                priority: 2,
                priority_center: 5,
                items : [
                    new ItemAchievements,
                    new ItemAchievements
                ]
            })
                .pre(function(data) {
                    _.each(data.items, function(item, $key) {
                        item.title = item.title;
                        item.description = item.description;
                        data.items[$key] = new ItemAchievements(item);
                    })
                    return data;
                })
            .serialize(data);
            self.getExample = getExample;
            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;

            function getExample() {
                return "Điền các thông tin về thành tích bạn đạt được từ hồi THPT đến giờ !";
            }
            function addItem() {
                self.items.push(new ItemAchievements().serialize());
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
