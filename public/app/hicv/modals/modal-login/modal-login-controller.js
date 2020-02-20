'use strict';

angular
    .module('hicv.design')
    .controller('ModalLoginController', ModalLoginController);

/* @ngInject */
function ModalLoginController($scope, $rootScope, Auth, CONFIG, $http, $uibModalInstance) {
    $scope.user = {
        'email': '',
        'password': ''
    };
    $scope.config = CONFIG;
    $scope.messageError = false;

    $scope.login = login;

    function login() {

        $http.post(CONFIG.API + '/api/user/login', $scope.user).success(function(res) {
            $rootScope.loading = false;
            if(res.status == 1) {
                Auth.logined = true;
                $scope.messageError = false;
                Auth.setUser(res.user);
                $uibModalInstance.close('login');
                $rootScope.$broadcast('save-cv');
            } else {
                $scope.messageError = res.message;
            }
        });
    }
    $scope.loginFace = function() {
        $http.get(CONFIG.API + '/dang-nhap-tai-khoan-facebook.html');
    }

    $rootScope.$on('event:social-sign-in-success', function(event, userDetails){
        $http({
            url: CONFIG.API + '/auth/login-social/' + userDetails.provider,
            method: "GET",
            params: userDetails
        }).then(function(res) {
            res = res.data;
            if(res.status == 1) {
                Auth.setUser(res.user);
                $uibModalInstance.close('login');
            } else {

            }
        });

    });

}
