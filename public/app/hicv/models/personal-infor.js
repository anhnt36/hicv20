(function() {
    'use strict';

    angular
        .module('hicv.design')
        .service('PersonalInfor', PersonalInfor);

    /* @ngInject */
    function PersonalInfor(DataModel) {

        return PersonalInfor;

        function PersonalInfor(data) {

            var self = new DataModel({
                id: 'InfoSection',
                template:  'template-person-info',
                position: 'head',
                key: 'info',
                height: 182,
                title: 'Person Infomation',
                icon: 'icon-user',
                priority: 0,
                priority_center: 0,
                name: {
                    value: ''
                },
                say: {
                    value: '',
                    display: true
                },
                phone: {
                    value: '',
                    display: true
                },
                email: {
                    value: '',
                    display: true
                },
                link: {
                    value: '',
                    display: true
                },
                location: {
                    value: '',
                    display: true
                },
                facebook: {
                    value: '',
                    display: true
                },
                linkedin: {
                    value: '',
                    display: true
                },
                skype: {
                    value: '',
                    display: true
                },
                image: {
                    value: '',
                    style: 0,
                    display: true
                }
            })
            .serialize(data);
            self.getExample = getExample;

            function getExample() {
                return "Điền các thông tin cá nhân của bạn, yêu cầu chính xác!";
            }
            self.page = 1;
            return self;
        }
    }

})();
