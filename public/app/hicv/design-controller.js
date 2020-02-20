(function () {
    'use strict';

    angular
        .module('hicv.design')

        .directive('clickOff', function ($parse, $document) {
            return {
                scope: {
                    onClickOff: '&'
                },
                compile: function ($element, attr) {
                    var fn = $parse(attr["clickOff"]);
                    return function (scope, element, attr) {
                        element.bind("click", function (event) {
                            event.stopPropagation();
                        });
                        angular.element(".feedback-wrapper").bind("click", function (event) {
                            scope.$apply(function () {
                                scope.onClickOff({$event: {target: element[0]}});
                            })
                        });
                    };
                }
            };
        })
        .directive('showPopover', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    scope.$watch('hoverPage', function () {
                        if (scope.hoverPage) {
                            element.get(0).dispatchEvent(new Event("showPopover"));
                        } else {
                            element.get(0).dispatchEvent(new Event("hidePopover"));
                        }
                    });
                }
            };
        })
        .directive('changeHeight', function () {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    scope.$watch(function() {
                        return element.height();
                    }, function() {
                        scope.$emit('change-height-all');
                    });
                }
            };
        })
        .directive('clickDatetime', function ($timeout) {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.on('click', function (event) {
                        scope.$apply(function () {

                            $timeout(function () {
                                var ele = angular.element(event.target);
                                var section = ele.closest('.resume-item-holder');
                                var popoverDatepicker = section.find('#cv-datetime');
                                popoverDatepicker.triggerHandler('click');
                            }, 50);
                        })
                    });
                }
            };
        })
        .directive('clickListIcon', function ($timeout) {
            return {
                restrict: 'A',
                link: function (scope, element) {
                    element.on('click', function (event) {
                        scope.$apply(function () {

                            $timeout(function () {
                                var ele = angular.element(event.target);
                                var section = ele.closest('.resume-item-holder');
                                var popoverDatepicker = section.find('#cv-list-icon');
                                popoverDatepicker.triggerHandler('click');
                            }, 50);
                        })
                    });
                }
            };
        })
        .directive('capitalizeFirst', function($parse) {
            return {
                require: 'ngModel',
                link: function(scope, element, attrs, modelCtrl) {
                    var capitalize = function(inputValue) {
                        if (inputValue == undefined) { inputValue = ''; }
                        var capitalized = inputValue.charAt(0).toUpperCase() +
                            inputValue.substring(1);
                        if(capitalized != inputValue) {
                            modelCtrl.$setViewValue(capitalized);
                            modelCtrl.$render();
                        }
                        return capitalized;
                    }
                    modelCtrl.$parsers.push(capitalize);
                    capitalize($parse(attrs.ngModel)(scope)); // capitalize initial value
                }
            };
        })
        .controller('DesignController', DesignController);

    function DesignController($scope,$q ,socialLoginService, $rootScope, $sce, Auth, DesignService, layoutService, $cookies, Hotkeys, $uibModal, $timeout, $http, CONFIG, Flash,$state, $window) {
        $scope.API = CONFIG.API;
        $rootScope.loading = false;
        $scope.registerHotkey = registerHotkey;
        $scope.errors = DesignService.errors;
        $scope.dynamicPopover = {
            templateUrl: 'myPopoverTemplate.html',
        };
        $scope.openLoginModal = openLoginModal;

        $scope.params = $state.params;
        $scope.placement = {
            options: [
                'top',
                'top-left',
                'top-right',
                'bottom',
                'bottom-left',
                'bottom-right',
                'left',
                'left-top',
                'left-bottom',
                'right',
                'right-top',
                'right-bottom'
            ],
            selected: 'top'
        };
        $scope.CalculateHeightPage = CalculateHeightPage;
        $scope.auth = Auth;
        $scope.rebuildData = rebuildData;
        $rootScope.changeDate = changeDate;
        $scope.exportPDF = exportPDF;
        $scope.getData = function () {
        };
        $scope.logout = function() {
            socialLoginService.logout();
        }
        $scope.menu = '';
        $scope.changeMenu = function (value) {
            $scope.menu = value
        }

        $scope.openRearrangeEditModal = openRearrangeEditModal;
        $scope.hoverPage = false;

        $scope.saveCV = saveCV;
        $scope.goBack = goBack;
        $scope.$on('save-cv', function(){
            saveCV();
        });
        $scope.$on('recalculation-height', function(){
            recalculationHeight();
        });

        $scope.$watchCollection('errors', function() {
            if($scope.errors.length > 0) {
                var errors = _.map($scope.errors, 'message');
                Flash.create('danger', errors[0]);
            }
        });



        $scope.$on('caculation-priority', function(){
            $rootScope.$broadcast('caculation-priority-layout');
        });

        $scope.$on('change-layout', function(){
            rebuildData();
        });

        $scope.$on('change-font', function () {
            rebuildData();
        });

        $scope.$on('change-color', function () {
            rebuildData();
        });

        $scope.$on('change-background', function () {
            rebuildData();
        });

        $scope.$on('change-data-cv', function () {
            rebuildData();
        });

        $scope.$on('click-add-section', function () {
            $timeout(function () {
                angular.element('#tp-new-section').triggerHandler('click');
            }, 500);
        });


        init();

        function init() {
            var defer = $q.defer();
            $http.get(CONFIG.API + '/api/current-user')
                .then(function(response) {
                    response = response.data;
                    if(response.status == 1) {
                        Auth.setUser(response.user);
                        return defer.resolve(true);
                    } else {
                        return defer.resolve(false);
                    }
                })
                .then(loadCV());


            function loadCV() {

                if($scope.params.param != "") {
                    $http.get(CONFIG.API + '/api/cv/' + $scope.params.param)
                        .then(function (res) {
                            res = res.data;
                            if(res.status == 1) {
                                res = res.data;
                                DesignService.loadCV(res);
                                $scope.cv = DesignService;
                                $scope.person = DesignService.data;
                                $scope.layout = DesignService.layout;
                                $scope.background = layoutService.backgrounds[DesignService.background].src;
                                $scope.font = layoutService.fonts[DesignService.font].family;
                                $scope.color = layoutService.colors[DesignService.color];
                                $rootScope.$broadcast('change-data-cv-layout');
                                return defer.resolve(true);
                            } else {
                                Flash.create('danger', "ID của CV sai !");
                            }
                        }, function errorCallback(response) {
                            return defer.resolve(false);
                            // called asynchronously if an error occurs
                            // or server returns response with an error status.
                        });
                } else {
                    DesignService.createNewCV();
                    $scope.cv = DesignService;
                    $scope.person = DesignService.data;
                    $scope.layout = DesignService.layout;
                    $scope.background = layoutService.backgrounds[DesignService.background].src;
                    $scope.font = layoutService.fonts[DesignService.font].family;
                    $rootScope.$broadcast('change-data-cv-layout');
                    return defer.resolve(true);
                }
            }
        }



        function exportPDF() {
            if(!Auth.logined) {
                openLoginModal();
            } else {
                if($scope.params.param == "" || parseInt($scope.params.param) == 0) {
                    Flash.create('danger', "ID của CV sai !");
                } else {
                    $rootScope.loading = true;
                    $http.post(CONFIG.API + '/api/exportPdf/' + $scope.params.param).success(function(res) {
                        $rootScope.loading = false;
                        if(res.status == 1) {
                            $window.open(res.file, '_blank');
                        } else {
                            Flash.create('danger', "Bạn vui lòng tạo CV trước khi tải PDF !");
                        }
                    });
                }
            }

        }

        function resetClickSection() {
            angular.element('.clickable').removeClass('selected-resume-item');
            angular.element('.clickable').removeClass('resume-section-selected');
            angular.element('.clickable').removeClass('resume-header-selected');
        }

        function rebuildData() {
            $scope.cv = DesignService;
            $scope.person = DesignService.data;
            $scope.layout = DesignService.layout;
            $scope.background = layoutService.backgrounds[DesignService.background].src;
            $scope.font = layoutService.fonts[DesignService.font].family;
            $scope.color = layoutService.colors[DesignService.color];
            $rootScope.$broadcast('change-data-cv-layout');

        }

        function changeDate(event) {
            $timeout(function () {
                var ele = angular.element(event.target);
                var section = ele.closest('.resume-item-holder');
                var popoverDatepicker = section.find('template-popover .datepicker');
                popoverDatepicker.click();
            }, 600);
        };

        function saveCV() {
            var data = {
                data: $scope.cv.data,
                layout: $scope.cv.layout,
                font: $scope.cv.font,
                color: $scope.cv.color,
                background: $scope.cv.background,
                numberPage: $scope.cv.numberPage
            };

            if(!Auth.logined) {
                openLoginModal();
            } else {
                if(DesignService.errors.length > 0) {
                    var errors = _.map(DesignService.errors, 'message');
                    Flash.create('danger', errors[0]);
                    return false;
                }
                data.seeker_id = Auth.user.id;

                var param = $scope.params.param != "" ? "/update/" + $scope.params.param : "";
                $http.post(CONFIG.API + '/api/cv' + param, data)
                    .then(function(response) {
                        if(response.data.status == 1) {
                            var message = '<strong>'+ response.data.message +'</strong>';
                            Flash.create('success', message);
                            $window.location.href = CONFIG.API + '/cv#/edit/' + response.data.resume_id;
                        }

                    });
            }
        }

        function openLoginModal () {
            $uibModal.open({
                templateUrl: 'app/hicv/modals/modal-login/modal-login.html',
                controller: 'ModalLoginController',
                size: 'lg',
                resolve: {
                    designService: DesignService
                }
            });
        };


        function openRearrangeEditModal () {
            CalculateHeightPage();
            $uibModal.open({
                templateUrl: 'app/hicv/modals/template-rearrange-edit/template-rearrange-edit.html',
                controller: 'TemplateRearrangeEditController',
                size: 'lg',
                resolve: {
                    designService: DesignService
                }
            });
        };

        // Register Hotkeys
        function registerHotkey($key, calledFunction) {
            var hotkey = Hotkeys.createHotkey({
                key: $key,
                callback: function (event) {
                    calledFunction(event);
                }
            });

            Hotkeys.registerHotkey(hotkey);
        }

        function CalculateHeightPage() {
            var element, height = 0;
            _.each(DesignService.data, function (item, $key) {
                element = $('#' + item.id).height() + 20;
                item.height = element;
            });
        }


        function goBack() {
            window.location.href = CONFIG.API + "/cv#/edit/";
        }

        $rootScope.clickInput = function (event) {
            DesignService.changeLayout = true;
            resetClickSection();
            if($scope.menu != 'text-example') $scope.changeMenu('text-example');
            else $rootScope.$broadcast('change-section-instruction');
            $(event.target).closest('.clickable').addClass('resume-header-selected');
            $scope.hoverPage = true;
        };
        $rootScope.clickOffInput = function (event) {
            DesignService.changeLayout = false;
            $(event.target).closest('.clickable').removeClass('resume-header-selected');
            $scope.hoverPage = false;
            if($scope.menu == 'text-example') $scope.menu = '';

        };
        $rootScope.clickInputTitleSection = function (event) {

            DesignService.changeLayout = true;
            $rootScope.$broadcast('reset-popover');
            resetClickSection();
            if($scope.menu != 'text-example') $scope.changeMenu('text-example');
            else $rootScope.$broadcast('change-section-instruction');
            $(event.target).closest('.clickable').addClass('resume-section-selected');
            $scope.hoverPage = true;
        };
        $rootScope.clickOffInputTitleSection = function (event) {

            DesignService.changeLayout = false;
            $rootScope.$broadcast('reset-popover');
            $(event.target).closest('.clickable').removeClass('resume-section-selected');
            $scope.hoverPage = false;
            if($scope.menu == 'text-example') $scope.menu = '';


        };
        $rootScope.clickInputItemSection = function (event) {
            DesignService.changeLayout = true;
            resetClickSection();
            if($scope.menu != 'text-example') $scope.changeMenu('text-example');
            else $rootScope.$broadcast('change-section-instruction');
            $(event.target).closest('.clickable').addClass('selected-resume-item');
            $scope.hoverPage = true;

        };
        $rootScope.clickOffInputItemSection = function (event) {
            DesignService.changeLayout = false;
            $(event.target).closest('.clickable').removeClass('selected-resume-item');
            $scope.hoverPage = false;
            if($scope.menu == 'text-example') $scope.menu = '';


        };
    }
})();