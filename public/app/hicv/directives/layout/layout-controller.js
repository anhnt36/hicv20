'use strict';

angular
    .module('hicv.design')
    .controller('layout', layout);

/* @ngInject */
function layout($scope, $rootScope, DesignService, layoutService, CONFIG, $state) {
    $scope.rebuildData = rebuildData;
    $scope.cv = DesignService;
    $scope.layout = layoutService;
    $scope.section_first = {};
    $scope.stylePage = {
        height: '940px'
    }
    init();

    function init() {
        $scope.pages_display = [];

        rearrangeSection();
        rebuildData();
    }

    $scope.$on('change-height-layout', function(){
        calculateHeightPage();
        rearrangeSection();
        rebuildData();
        $rootScope.$broadcast('change-data-after-arrange');
    });

    $scope.$on('change-height-all', function(){
        calculateHeightPage();
        rearrangeSection();
        rebuildData();
        $rootScope.$broadcast('change-data-after-arrange');
    });
    $scope.$on('change-data-cv-layout', function(){
        rearrangeSection();
        rebuildData();
    });

    function rebuildData() {

        $scope.pages_display = {};
        $scope.section_first = DesignService.data['info'];
        if(DesignService.layout == 'double') {
            $scope.pages = _.sortBy(_.filter(DesignService.data, function (tp) {
                return tp.key != 'info';
            }));
            $scope.pages_display = {
                    left:   _.filter($scope.pages, function (data) {
                        return data.position == 'left';
                    }),
                    right:  _.filter($scope.pages, function (data) {
                        return data.position == 'right';
                    })
                };

        } else {

            $scope.pages_display = _.sortBy(_.filter(DesignService.data, function (tp) {
                return tp.key != 'info';
            }));


        }
        caculateTotalHeightPage();
    }

    function calculateHeightPage() {
        var height = 0;
        var a = 0;
        _.each(DesignService.data, function (item, $key) {
            height = $('#' + item.id).height() + 20;
            if($key == 'info') {
                height = height - 20;
            }
            DesignService.data[$key].height = height;
            a += height;
        });
    }

    function caculateTotalHeightPage() {
        var total = 0;
        if(DesignService.layout == 'double') {
            var heightLeft = 0;
            _.each(_.filter(DesignService.data, function (data) {
                return data.position == 'left';
            }), function(p) {
                heightLeft += p.height;
            });

            var heightRight = 0;
            _.each(_.filter(DesignService.data, function (data) {
                return data.position == 'right';
            }), function(p) {
                heightRight += p.height;
            });

            total += heightRight > heightLeft ? heightRight : heightLeft;
            total += DesignService.data['info'].height;
        } else {
            _.each(DesignService.data, function(p) {
                total += p.height;
            });
        }

        $scope.stylePage.height = (total + 120).toString() + 'px';
    }

    function rearrangeSection() {
        var dataSections = {};
        var height = 0;
        var numerPage = 1;
        $scope.head = _.find(DesignService.data, ['position', 'head']);

        if(DesignService.layout == 'double') {
            var rightSections = _.sortBy(_.filter(DesignService.data, ['position', 'right']), ['priority']);
            var leftSections = _.sortBy(_.filter(DesignService.data, ['position', 'left']), ['priority']);

            _.each(rightSections, function (section) {
                if(section.key == 'info') return;
                height += section.height;
                var heightCompare = numerPage == 1 ? CONFIG.HEIGHT_PAGE - 182 : CONFIG.HEIGHT_PAGE;
                if (height > heightCompare) {
                    height = section.height;
                    numerPage++;
                }
                section.page = numerPage;
                dataSections[section.key] = section;
            })

            height = 0;
            numerPage = 1;

            _.each(leftSections, function (section) {

                if(section.key == 'info') return;
                height += section.height;
                var heightCompare = numerPage == 1 ? CONFIG.HEIGHT_PAGE - 182 : CONFIG.HEIGHT_PAGE;
                if (height > heightCompare) {
                    height = section.height;
                    numerPage++;
                }
                section.page = numerPage;
                dataSections[section.key] = section;
            });
        } else {
            var rightSections = _.sortBy(DesignService.data, ['priority_center']);

            _.each(rightSections, function (section) {
                if(section.key == 'info') return;
                height += section.height;
                var heightCompare = numerPage == 1 ? CONFIG.HEIGHT_PAGE - 182 : CONFIG.HEIGHT_PAGE;
                if (height > heightCompare) {
                    height = section.height;
                    numerPage++;
                }
                section.page = numerPage;
                dataSections[section.key] = section;
            });
        }
        if($scope.head)
            dataSections[$scope.head.key] = $scope.head;
        DesignService.numberPage = numerPage;
        DesignService.data = dataSections;
    }
}
