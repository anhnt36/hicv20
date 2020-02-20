(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateSkillModel', TemplateSkillModel);

    /* @ngInject */
    function TemplateSkillModel(DataModel, TemplateModel, ItemSkill, DatePeriodModel) {

        return TemplateSkillModel;

        function TemplateSkillModel(data) {

            var self = new TemplateModel().extend({
                id: 'SkillSection-0',
                template: 'template-skill',
                key: 'skill',
                height: 175,
                position: 'left',
                title: 'Skill',
                icon: 'fa fa-cogs',
                priority: 1,
                priority_center: 10,
                items: [
                    new ItemSkill,
                    new ItemSkill
                ]
            }).pre(function (data) {
                _.each(data.items, function (item, $key) {
                    data.items[$key] = new ItemSkill(item);
                })
                return data;
            }).serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;
            self.getExampleSection = getExampleSection;

            function getExample() {
                return "Điền các kỹ năng nổi bật của bạn !";
            }
            function addItem() {
                self.items.push(new ItemSkill().serialize());
            }
            function deleteItem(key) {
                self.items.splice(key, 1);
            }
            function getKey() {
                return  _.upperFirst(self.key);
            }
            function getExampleSection() {
                return [
                    new TemplateModel().extend({
                        id: 'SkillSection-0',
                        template: 'template-skill',
                        key: 'skill',
                        position: 'left',
                        title: 'Skill',
                        items: [
                            new ItemSkill(
                                {
                                    name: 'Lập trình',
                                    level:{
                                        value: 3,
                                        display: true
                                    },
                                }),

                            new ItemSkill(
                                {
                                    name: 'Tự học',
                                    level:{
                                        value: 4,
                                        display: true
                                    },
                                }),
                        ]
                    }),
                    new TemplateModel().extend({
                        id: 'SkillSection-0',
                        template: 'template-skill',
                        key: 'skill',
                        height: 175,
                        position: 'left',
                        title: 'Skill',
                        icon: 'fa fa-cogs',
                        priority: 1,
                        priority_center: 6,
                        items: [
                            new ItemSkill,
                            new ItemSkill
                        ]
                    }),
                ];
            }
            return self;
        }

    }

})();
