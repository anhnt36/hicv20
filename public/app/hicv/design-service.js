(function () {
    'use strict';
    angular
        .module('hicv.design')
        .factory('DesignService', DesignService);

    /* ngInject */
    function DesignService(PersonalInfor,
                           TemplateSkillModel,
                           TemplateExperienceModel,
                           TemplateEducationModel,
                           TemplateAchievementsModel,
                           TemplateLanguageModel,
                           TemplateProjectModel,
                           TemplateSummaryModel,
                           TemplatePassionModel,
                           TemplateStrengthModel) {
        var self = {
            all: {
                achievements: new TemplateAchievementsModel,
                education: new TemplateEducationModel,
                experience: new TemplateExperienceModel,
                info: new PersonalInfor,
                languages: new TemplateLanguageModel,
                project: new TemplateProjectModel,
                skill: new TemplateSkillModel,
                summary: new TemplateSummaryModel,
                passion: new TemplatePassionModel,
                strength: new TemplateStrengthModel
            },
            data: {},
            layout: 'single',
            changeLayout: false,
            font: 'lato',
            color: 'blue',
            background: 'default',
            numberPage: 0,
            selectedSection: '',
            errors: [],
        };
        self.createNewCV = createNewCV;
        self.setError = setError;
        self.loadCV = loadCV;

        self.delSection = function (section) {
            delete self.data[section];
            var i = 0;
            _.forEach(_.sortBy(self.data, function (v) {
                return v.priority;
            }), function (value) {
                i++;
                self.data[_.findKey(self.data, function (v) {
                    return v.template == value.template;
                })].priority = i;
            });
        };

        self.addSection = function (section) {
            if (!!_.find(self.all, function (_section) {
                    return !!_.find(section, function (self, k) {
                            return k == 'template';
                        }) && section.template == _section.template;
                })) {
                var i = 0;
                _.forEach(_.sortBy(self.data, function (v) {
                    return v.priority;
                }), function (value) {
                    i++;
                    self.data[_.findKey(self.data, function (v) {
                        return v.template == value.template;
                    })].priority = i;
                });
                section.priority = _.size(self.data) + 1;
                self.data[_.findKey(self.all, function (o) {
                    return o.template == section.template
                })] = section;
            }
        };
        self.save = function() {
            console.log('save');
        }

        function loadCV(data) {
            self.layout = data.layout;
            self.font = data.font;
            self.color = data.color;
            self.background = data.background;
            self.numberPage = data.numberPage;
            _.each(data.data, function(item, $key) {
                self.data[$key] = self.all[$key].serialize(item);
            });
        }

        function setError(obj) {
            self.errors.push(obj);
        }

        function createNewCV() {
            self.data = {
                achievements: new TemplateAchievementsModel,
                education: new TemplateEducationModel,
                experience: new TemplateExperienceModel,
                info: new PersonalInfor,
                summary: new TemplateSummaryModel,
                passion: new TemplatePassionModel,
                strength: new TemplateStrengthModel
            };
            self.layout = 'single';
            self.font = 'lato';
            self.color = 'blue';
            self.background = 'default';
            self.numberPage = 0;
        }
        return self;
    }
})();