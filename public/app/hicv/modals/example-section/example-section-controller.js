'use strict';

angular
    .module('hicv.design')
    .controller('ExampleSectionController', ExampleSectionController);

/* @ngInject */
function ExampleSectionController($scope, $rootScope, DesignService, CONFIG, DatePeriodModel,
                                  ItemSkill, TemplateSkillModel,
                                  ItemProject, TemplateProjectModel,
                                  ItemPassion, TemplatePassionModel,
                                  TemplateStrengthModel,
                                  ItemLanguage, TemplateLanguageModel,
                                  ItemExperience, TemplateExperienceModel,
                                  ItemEducation, TemplateEducationModel,
                                  ItemAchievements, TemplateAchievementsModel


) {
    $scope.cv = DesignService;
    $scope.myInterval = 5000;
    $scope.noWrapSlides = false;
    $scope.active = 0;
    $scope.exampleSection = exampleSection;
    $scope.slides = [];
    $scope.indexSlide = 0;
    $scope.maxSlide = 0;
    init();
    function init() {
        _.each($scope.exampleSection(DesignService.selectedSection), function(section) {
            $scope.slides.push({
                template: DesignService.data[DesignService.selectedSection].template,
                data: section
            });
        });
        $scope.maxSlide = $scope.slides.length;
    }



    function exampleSection(selectedSection) {
        var data = {
            skill: exampleSkill(),
            project: exampleProject(),
            passion: examplePassion(),
            strength: exampleStrength(),
            languages: exampleLanguage(),
            experience: exampleExperience(),
            education: exampleEducation(),
            achievements: exampleAchievements()
        }
        if(data[selectedSection]) {
            console.log(data[selectedSection]);
            return  data[selectedSection];
        }
        return false;
    }

    function exampleSkill() {
        return [
            new TemplateSkillModel({
                name: "Kỹ năng",
                items: [
                    new ItemSkill(
                        {
                            name: 'Lập trình',
                            level:{
                                value: 3,
                                display: true
                            },
                        }),
                ]
            }),
            new TemplateSkillModel({
                name: "Kỹ năng",
                items: [
                    new ItemSkill(
                        {
                            name: 'Lập trình',
                            level:{
                                value: 3,
                                display: true
                            },
                        }),

                ]
            }),
            new TemplateSkillModel({
                name: "Kỹ năng",
                items: [
                    new ItemSkill(
                        {
                            name: 'Lập trình',
                            level:{
                                value: 3,
                                display: true
                            },
                        }),

                ]
            }),
        ]
    }

    function exampleProject() {
        return [
            new TemplateProjectModel({
                name: "Dự án đã tham gia",
                items: [
                    new ItemProject(
                        {
                            title: 'Dự án R&D',
                            company:{
                                value: 'seta international',
                                display: true
                            },
                            link:{
                                value: 'seta.com',
                                display: true
                            },
                            datePeriod: new DatePeriodModel({
                                monthFrom: '12',
                                yearFrom: '2009',
                                monthTo: '3',
                                yearTo: '2010',
                                onGoing: true,
                            }),
                            location: {
                                value: '45 Duy tân',
                                display: true
                            },
                            shortSummary: {
                                value: 'Là một công ty ...',
                                display: true
                            },
                            example: {
                                display: true,
                                data: [
                                    'Học thêm về công nghệ mới',
                                    'Cải thiện các kiến thức về nghiệp vụ',
                                ]
                            }
                        }),
                ]
            }),
            new TemplateProjectModel({
                name: "Các dự án đã làm",
                items: [
                    new ItemProject(
                        {
                            title: 'Dự án HICV',
                            company:{
                                value: '24h',
                                display: true
                            },
                            link:{
                                value: '24h.vn',
                                display: true
                            },
                            datePeriod: new DatePeriodModel({
                                monthFrom: '12',
                                yearFrom: '2009',
                                monthTo: '3',
                                yearTo: '2010',
                                onGoing: true,
                            }),
                            location: {
                                value: '45 Duy tân',
                                display: true
                            },
                            shortSummary: {
                                value: 'Là một công ty ...',
                                display: true
                            },
                            example: {
                                display: true,
                                data: [
                                    'Học thêm về công nghệ mới',
                                    'Cải thiện các kiến thức về nghiệp vụ',
                                ]
                            }
                        }),

                ]
            }),
        ]
    }

    function examplePassion() {
        return [
            new TemplatePassionModel({
                name: 'Sở thích của bạn',
                items: [
                    new ItemPassion({
                        icon: {
                            value: 'fa fa-hand-scissors-o',
                            display: true
                        },
                        description: {
                            value: 'Chơi game ở nhà',
                            display: false
                        },
                        name: 'Chơi game'
                    }),
                    new ItemPassion({
                        icon: {
                            value: 'fa fa-hand-scissors-o',
                            display: true
                        },
                        description: {
                            value: 'Đá bong ở các sân vận động',
                            display: false
                        },
                        name: 'Đá bóng'
                    })
                ]
            })
        ]
    }

    function exampleStrength() {
        return [
            new TemplateStrengthModel({
                name: 'Điểm mạnh của bạn',
                items: [
                    new ItemPassion({
                        key: 'strength',
                        icon: {
                            value: 'fa fa-hand-scissors-o',
                            display: true
                        },
                        description: {
                            value: 'Có khả năng tự học ngôn ngữ mới, công nghệ mới',
                            display: false
                        },
                        name: 'Tự học'
                    }),
                    new ItemPassion({
                        key: 'strength',
                        icon: {
                            value: 'fa fa-hand-scissors-o',
                            display: true
                        },
                        description: {
                            value: 'có khả năng hòa đồng với mọi người',
                            display: false
                        },
                        name: 'Hòa đồng'
                    })
                ]
            })
        ]
    }

    function exampleLanguage() {
        return [
            new TemplateLanguageModel({
                name: 'Điểm mạnh của bạn',
                items: [
                    new ItemLanguage({
                        language: 'Tiếng Anh',
                        proficiency: {
                            display: true
                        },
                        level: {
                            value: 4,
                            display: true
                        },
                    }),
                    new ItemLanguage({
                        language: 'Tiếng Nhật',
                        proficiency: {
                            display: true
                        },
                        level: {
                            value: 5,
                            display: true
                        },
                    })
                ]
            })
        ]
    }

    function exampleExperience() {
        return [
            new TemplateExperienceModel({
                name: 'Kinh nghiệm',
                items: [
                    new ItemExperience({
                        title: 'PHP developer',
                        company:{
                            value: 'Seta',
                            display: true
                        },
                        link:{
                            value: 'seta.com',
                            display: true
                        },
                        datePeriod: new DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: false,
                        }),
                        location: {
                            value: 'Duy tân cầu giấy',
                            display: true
                        },
                        shortSummary: {
                            value: 'Là một công ty outsourcing',
                            display: true
                        },
                        example: {
                            display: true,
                            data: [
                                'Học hỏi thêm kinh nghiệm về lập trình web',
                            ]
                        }
                    }),
                    new ItemExperience({
                        title: '24h',
                        company:{
                            value: '24h',
                            display: true
                        },
                        link:{
                            value: '24h.com',
                            display: true
                        },
                        datePeriod: new DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: true,
                        }),
                        location: {
                            value: 'Duy tân cầu giấy',
                            display: true
                        },
                        shortSummary: {
                            value: 'là một công ty chuyên về các sản phẩm product',
                            display: true
                        },
                        example: {
                            display: true,
                            data: [
                                'Hoc hỏi thêm về công nghệ mới',
                            ]
                        }
                    })
                ]
            }),
            new TemplateExperienceModel({
                name: 'Kinh nghiệm',
                items: [
                    new ItemExperience({
                        title: 'AngularJS developer',
                        company:{
                            value: 'Seta',
                            display: true
                        },
                        link:{
                            value: 'seta.com',
                            display: true
                        },
                        datePeriod: new DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: true,
                        }),
                        location: {
                            value: 'Duy tân cầu giấy',
                            display: true
                        },
                        shortSummary: {
                            value: 'Là một công ty outsourcing',
                            display: true
                        },
                        example: {
                            display: true,
                            data: [
                                'Học hỏi thêm kinh nghiệm về lập trình web',
                            ]
                        }
                    }),
                    new ItemExperience({
                        title: '24h',
                        company:{
                            value: '24h',
                            display: true
                        },
                        link:{
                            value: '24h.com',
                            display: true
                        },
                        datePeriod: new DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: true,
                        }),
                        location: {
                            value: 'Duy tân cầu giấy',
                            display: true
                        },
                        shortSummary: {
                            value: 'là một công ty chuyên về các sản phẩm product',
                            display: true
                        },
                        example: {
                            display: true,
                            data: [
                                'Hoc hỏi thêm về công nghệ mới',
                            ]
                        }
                    })
                ]
            })
        ]
    }

    function exampleEducation() {
        return [
            new TemplateEducationModel({
                name: 'Bằng cấp',
                items: [
                    new ItemEducation({
                        field: {
                            value: 'Bằng tốt nghiệp cấp 3',
                            display: true
                        },
                        school: {
                            value: 'Trường THPT Hà Trung',
                            display: true
                        },
                        datePeriod: new DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: true,
                        }),
                        GPA: {
                            total: 10,
                            rate: 9,
                            display: true
                        }
                    }),
                    new ItemEducation({
                        field: {
                            value: 'Bằng cử nhân',
                            display: true
                        },
                        school: {
                            value: 'Đại học Công Nghệ - ĐHQGHN',
                            display: true
                        },
                        datePeriod: DatePeriodModel({
                            monthFrom: '12',
                            yearFrom: '2009',
                            monthTo: '3',
                            yearTo: '2010',
                            onGoing: true,
                        }),
                        GPA: {
                            total: 10,
                            rate: 8,
                            display: true
                        }
                    })
                ]
            })
        ]
    }

    function exampleAchievements() {
        return [
            new TemplateAchievementsModel({
                name: 'Bằng cấp',
                items: [
                    new ItemAchievements({
                        title: {
                            value: 'Có khả năng tự nghiên cứu công nghệ mới',
                            display: true
                        },
                        description: {
                            value: 'Có khả năng tự nghiên cứu công nghệ mới',
                            display: true
                        },
                    }),
                    new ItemAchievements({
                        title: {
                            value: 'Hòa đồng với mọi người',
                            display: true
                        },
                        description: {
                            value: 'Hòa đồng với mọi người',
                            display: true
                        },
                    })
                ]
            })
        ]
    }


}
