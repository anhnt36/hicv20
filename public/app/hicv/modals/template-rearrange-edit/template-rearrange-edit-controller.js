'use strict';

angular
    .module('hicv.design')
    .controller('TemplateRearrangeEditController', TemplateRearrangeEditController);

/* @ngInject */
function TemplateRearrangeEditController($scope, $rootScope, DesignService, CONFIG) {
    $scope.cv = DesignService;
    $scope.dataCV = {};
    $scope.rateZoom = 170/CONFIG.HEIGHT_PAGE;
    $scope.objectDeleted = {items: [], dragging: false};
    $scope.rebuildDataReArrange = rebuildDataReArrange;
    $scope.addSection = addSection;
    $scope.addStyle = addStyle;
    $scope.$on('change-data-after-arrange', function () {
        rebuildDataReArrange();
    });
    $scope.upperCaseFirstCharacter = upperCaseFirstCharacter;


    init();
    function init() {
        rebuildDataReArrange();
    }



    function rebuildDataReArrange() {
        $scope.dataCV = {};
        _.each($scope.cv.data, function(item, key) {
            if(key != 'info') {
                $scope.dataCV[key] = item.serialize();
            }
        });
        $scope.lists = [];

        if($scope.cv.layout == 'double') {
            $scope.pages =_.groupBy(_.sortBy($scope.dataCV,function (sort) {
                return sort.priority;
            }), 'page');
            _.each($scope.pages, function(page, $index) {
                $scope.lists.push({
                    left:   {
                        items:  _.filter($scope.pages[$index], function (data) {
                            return data.position == 'left';
                        }),
                        dragging: false},
                    right:   {
                        items:  _.filter($scope.pages[$index], function (data) {
                            return data.position == 'right';
                        }),
                        dragging: false}
                });
            });
        } else {
            $scope.pages =_.groupBy(_.sortBy($scope.dataCV,function (sort) {
                return sort.priority_center;
            }), 'page');
            _.each($scope.pages, function(page, $index) {
                $scope.lists.push({
                    center:   {
                        items:  $scope.pages[$index],
                        dragging: false}

                });
            });
        }
    };

    function addStyle(height) {
        var style = {
            "height": (height * $scope.rateZoom) + "px",
            "position": "relative"
        };
        return style;
    }

    function addSection() {
        $scope.$close();
        $rootScope.$broadcast('click-add-section');
    }

    function caculatePriority() {
        var object = {};
        if($scope.cv.layout == 'double') {
            _.each($scope.lists, function(page, $index) {
                _.each(page.left.items, function(item, index) {
                    if(_.find($scope.objectDeleted.items, ['key', item.key])) return;
                    item.priority = index;
                    item.position = 'left';
                    object[item.key] = item;
                });
                _.each(page.right.items, function(item, index) {
                    if(_.find($scope.objectDeleted.items, ['key', item.key])) return;
                    item.priority = index;
                    item.position = 'right';
                    object[item.key] = item;
                });
            });
        } else {
            var index = 0;
            _.each($scope.lists, function(page) {
                _.each(page.center.items, function(item) {
                    if(_.find($scope.objectDeleted.items, ['key', item.key])) return;
                    item.priority_center = index;
                    object[item.key] = item;
                    index++;
                });
            });
        }
        _.each($scope.cv.data, function(item, key) {
            if(object.hasOwnProperty(key) && !_.find($scope.objectDeleted.items, ['key', item.key])) {
                $scope.cv.data[key] = item.serialize(object[key]);
            } else {
                if(key != 'info') {
                    delete $scope.cv.data[key];
                }
            }
        });
        if($scope.objectDeleted.items.length > 0) {
            rebuildDataReArrange();
            $scope.objectDeleted.items = [];

        }

        $rootScope.$broadcast('change-height-layout');
    }

    function upperCaseFirstCharacter(string) {
        return _.upperFirst(string);
    }



    // Drap and drop
    $scope.objectSelected = '';
    $scope.listHasObjectSelected = '';
    $scope.onDragstart = function(list, event) {
        list.dragging = true;
        if (event.dataTransfer.setDragImage) {
            var img = new Image();
            img.src = '';
            event.dataTransfer.setDragImage(img, 2, 2);
        }
    };

    $scope.onDrop = function(list, items, index, isDelete) {
        angular.forEach($scope.listHasObjectSelected.items, function(item, key) {
            if(item.key == $scope.objectSelected[0].key) {
                $scope.listHasObjectSelected.items.splice(key, 1);
            }
        });
        angular.forEach(items, function(item) {
            item.selected = false;
        });
        list.items = list.items.slice(0, index)
            .concat(items)
            .concat(list.items.slice(index));
        caculatePriority();

        return true;
    }

    $scope.onMoved = function(list) {
        list.items = list.items.filter(function(item) { return !item.selected; });
    };

    $scope.getSelectedItemsIncluding = function(list, item) {
        item.selected = true;
        $scope.listHasObjectSelected = list;
        $scope.objectSelected = list.items.filter(function(item) {
            return item.selected;
        });
        return $scope.objectSelected;
    };
}
