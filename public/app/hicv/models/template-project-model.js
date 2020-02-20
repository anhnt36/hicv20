(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('TemplateProjectModel', TemplateProjectModel);

    /* @ngInject */
    function TemplateProjectModel(DataModel, TemplateModel, ItemProject, DatePeriodModel) {

        return TemplateProjectModel;

        function TemplateProjectModel(data) {

            var self = new TemplateModel().extend({
                id: 'ActivitySection',
                template: 'template-project',
                key: 'project',
                height: 332,
                position: 'right',
                icon: 'icon-61-free-project-01',
                title: 'Project',
                priority: 3,
                priority_center: 4,
                items : [
                    new ItemProject,
                    new ItemProject
                ]
            }).pre(function (data) {
                _.each(data.items, function (item, $key) {
                    data.items[$key] = new ItemProject(item);
                });
                return data;
            }).serialize(data);

            self.addItem = addItem;
            self.deleteItem = deleteItem;
            self.getKey = getKey;
            self.getExample = getExample;

            function getExample() {
                return "Điền thông tin các dự án bạn đã từng tham gia \n " +
                    "nêu càng chi tiết càng tốt (vị trí, khả năng học hỏi ...)";
            }
            function addItem() {
                self.items.push(new ItemProject().serialize());
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
