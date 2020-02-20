(function() {
    "use strict";
    
    angular
        .module('hicv.design')
        .directive('hocDirective', ['$compile', function($compile) {
            
            return {
                restrict: 'E',
                scope: {
                    data: '=',
                    type: '='
                },
                replace: true,
                template: '<div></div>',
                link: function(scope, iElement, iAttrs, controller) {

                    function buildComp(type) {
                        var example = "";
                        if(iAttrs.isExample == "true") {
                            example = 'is-example="isExample"';
                        }
                        var element = '<' + type + ' data="data" ' + example + '></' + type + '>';
                        iElement.html(element);
                        $compile(iElement)(scope);
                    }

                    scope.$watch('type', function(newVal) {
                        buildComp(newVal);
                    });

                },
                controller: function($scope) {
                    
                }
            }
        }])
    
})();