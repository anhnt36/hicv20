(function () {
    'use strict';
    angular
        .module('hicv.design')
        .service('layoutService', layoutService);

    /* ngInject */
    function layoutService() {
        var self = {
            layouts: {
                double: {
                    thumb: 'cv-layout-double-HICV.jpg',
                    title: 'Double column',
                    locked: false
                },
                single: {
                    thumb: 'cv-layout-single-HICV.jpg',
                    title: 'Single column',
                    locked: false
                },
                // compact: {
                //     thumb: 'compact.png',
                //     title: 'Compact',
                //     locked: true
                // }
            }, // 1 column or 2 column,
            fonts: {
                lato: {
                    family: 'Lato',
                    title: 'Lato',
                    locked: false
                },
                raleway: {
                    family: 'Raleway',
                    title: 'Raleway',
                    locked: false
                }
            },
            colors: {
                blue: {
                    menuTitle: 'background: rgb(0, 0, 0)',
                    menuHead: 'background: rgb(0, 140, 255)',
                    applyTitle: '#000000',
                    applyHead: '#008CFF',
                    locked: false
                },
                green: {
                    menuTitle: 'background: rgb(0, 0, 0)',
                    menuHead: 'background: rgb(0, 180, 0)',
                    applyTitle: '#000000',
                    applyHead: '#00B400',
                    locked: false
                }
            },
            backgrounds: {
                default:{
                    src: '557025919b54a31e81ae82037c8374ec.jpg',
                    bgpos: 'b00',
                    locked: false
                },
                lp: {
                    src: 'f5a28bd0fefbdea27138370e0d0ab333.svg',
                    bgpos: 'b05',
                    locked: false
                },
                wa: {
                    src: 'ead763d98973496998476ba2d5b6b5b4.svg',
                    bgpos: 'b09',
                    locked: false
                },
                to: {
                    src: 'f3e35038ab52f56f3a389234aea10fdc.svg',
                    bgpos: 'b11',
                    locked: false
                }
            }
        };

        return self;
    }
})();