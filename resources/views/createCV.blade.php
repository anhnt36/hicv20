<!DOCTYPE html>
<html>
<head>
    <title>Hi-CV</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CRoboto:300,400,700%7CLato:400,700,800%7CPlayfair+Display:400,700%7CAbril+Fatface%7CRaleway:300,400,600,700%7CMontserrat:400,700%7CExo+2:400,600%7COswald:300,400,700%7CChivo%7CRoboto+Slab:400,700&amp;subset=latin,cyrillic-ext,latin-ext,cyrillic,latin,cyrillic-ext,latin-ext,cyrillic,latin,cyrillic-ext,latin-ext,cyrillic,latin,latin-ext,cyrillic,latin,latin-ext,latin,latin-ext,latin,latin,latin-ext,cyrillic,latin,latin-ext,latin,latin,cyrillic-ext,latin-ext,cyrillic" media="all">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/angular-bootstrap/ui-bootstrap-csp.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('bower_components/angularjs-slider/dist/rzslider.min.css') }}">
</head>
<body ng-app="hicv">
<div ui-view="hicv-header"></div>
<div ui-view="hicv-body"></div>

<script type="text/javascript" src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-animate/angular-animate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-ui-router/release/angular-ui-router.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-route/angular-route.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-bootstrap/ui-bootstrap.min.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('bower_components/angular-sanitize/angular-sanitize.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/lodash/dist/lodash.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-hotkeys-light/angular-hotkeys-light.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-drag-and-drop-lists/angular-drag-and-drop-lists.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-elastic/elastic.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/ng-focus-if/focusIf.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-ui-router-uib-modal/angular-ui-router-uib-modal.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/ng-file-upload-shim/ng-file-upload-shim.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/ng-file-upload/ng-file-upload.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-translate/angular-translate.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-flash-alert/dist/angular-flash.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/rzslider.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-resource/angular-resource.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/angular-cookies.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angular-base64-upload/dist/angular-base64-upload.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('bower_components/angularjs-social-login/angularjs-social-login.js') }}"></script>


<!--<script type="text/javascript" src="{{ URL::asset('bower_components/angular-loader/angular-loader.min.js') }}"></script>-->

<script src="{{ URL::asset('app/hicv/base/hicv-datamodel.js') }}"></script>
<script src="{{ URL::asset('app/hicv/base/hicv.js') }}"></script>
<script src="{{ URL::asset('app/hicv/base/hicv-config.js') }}"></script>


<!--Model-->


<script src="{{ URL::asset('app/hicv/design.js') }}"></script>
<script src="{{ URL::asset('app/hicv/auth.js') }}"></script>
<script src="{{ URL::asset('app/hicv/APIInterceptor.js') }}"></script>
<script src="{{ URL::asset('app/hicv/design-service.js') }}"></script>
<script src="{{ URL::asset('app/hicv/layout-service.js') }}"></script>
<script src="{{ URL::asset('app/hicv/translate-config.js') }}"></script>


<script src="{{ URL::asset('app/hicv/design-controller.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('app/hicv/models/date-period.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/base/hoc-directive.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/personal-infor.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-experience-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-experience.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-education-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-education.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-achievements-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-achievements.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-language-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-language.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-project-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-project.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-skill-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-skill.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-summary-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-passion-model.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/item-passion.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/models/template-strength-model.js') }}"></script>



<!--Directives-->
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/layout/layout.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/layout/layout-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/text/text.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/text/text-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/check-display-field/check-display-field.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/check-display-field/check-display-field-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/date-period/date-period.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/date-period/date-period-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/range-slider/range-slider.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/range-slider/range-slider-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/list-icon/list-icon.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/list-icon/list-icon-controller.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-experience/template-experience.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-experience/template-experience-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-education/template-education.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-education/template-education-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-person-info/template-person-info.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-person-info/template-person-info-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-achievements/template-achievements.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-achievements/template-achievements-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-language/template-language.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-language/template-language-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-project/template-project.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-project/template-project-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-popover/template-popover.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-popover/template-popover-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-display-field/template-display-field.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-display-field/template-display-field-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-new-sections/left-menu-new-sections.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-new-sections/left-menu-new-sections-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/left-menu-change-layout.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/left-menu-change-layout-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/left-menu-change-font.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/left-menu-change-font-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/text-example.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/text-example-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/change-color.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/change-color-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/change-background.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/left-menu-change-layout/change-background-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-skill/template-skill.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-skill/template-skill-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-summary/template-summary.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-summary/template-summary-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-passion/template-passion.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-passion/template-passion-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-strength/template-strength.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/directives/template-strength/template-strength-controller.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('app/hicv/modals/template-rearrange-edit/template-rearrange-edit-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/modals/modal-login/modal-login-controller.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('app/hicv/modals/example-section/example-section-controller.js') }}"></script>

</body>
</html>