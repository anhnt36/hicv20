(function () {
    'use strict';
    angular
        .module('hicv.design')
        .service('Auth', Auth);

    /* ngInject */
    function Auth() {
        var self = {
            access_token: '',
            logined: false,
            user: {}
        };
        self.setUser = setUser;
        self.getToken = getToken;
        init();
        function init(){

        }
        function setUser($user) {
            self.user = $user;
            self.logined = true;
        }
        function getToken() {
            return self.access_token;
        }
        return self;
    }
})();