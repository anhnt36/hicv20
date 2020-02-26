(function () {
    'use strict';
    angular
        .module('hicv.design')
        .config(['$translateProvider', function ($translateProvider) {
        $translateProvider.translations('en', getEnglishLanguage());

        $translateProvider.translations('vi', getVietnameseLanguage());

        $translateProvider.preferredLanguage('vi');

        function getEnglishLanguage() {
            return {
                yourName : '名前',
                briefAboutYou : 'You in a word and two',
                phone : '携帯電話',
                websiteOrLink : 'Website/Link',
                email : 'メール
                location : 'Location',

                experience : '経験',
                titleOrPosition : 'タイトル/位置',
                company : 'Company',
                companyDescription : 'Company Description',
                datetime : 'Datetime',
                exampleOutcomeOfActivity : 'What was an example of a successful outcome of this activity? (e.g. Made 30+ partnerships)',

                project : 'Project',
                projectOrActivity : 'Project/Activity name',
                shortSummaryYourWork : 'Short summary of your work',

                achievements : 'Achievements',
                yourMostProudOf : 'What are you most proud of?',
                aBitYourAchievement : 'A bit about your achievement',

                language : 'Language',
                beginner : 'Beginner',

                education : 'Education',
                degreeOrFieldStudy : 'Degree or Field of Study',
                schoolOrUniversity: 'Trường',
                gpa: 'Điểm trung bình',

                skill: 'スキル',

                passion: 'Passion',
                yourPassion: 'Your Passion',
                description: 'Description',

                summary: 'Summary',
                summaryDescription: "What critical problems are you well positioned to solve? A bit about yourself.",

                strengh: 'Strengths',
                yourUniqueTalent: 'Your Unique Talent',
                yourUniqueTalentDescription: 'How did you acquire it? What did it result in?',
                1: 'Jan',
                2 : 'Feb',
                3 : 'Mar',
                4 : 'Apr',
                5 : 'May',
                6 : 'Jun',
                7 : 'Jul',
                8 : 'Aug',
                9 : 'Sep',
                10 : 'Oct',
                11 : 'Nov',
                12: 'Dec',
                ongoing: 'ongoing',
                linkWebsiteCompany: 'Link website company',
                saveCV: 'saveCV',
                download: 'Download',
                back: '戻る',
                newSections: 'New Sections',
                rearrange: 'Rearrange/Edit',
                templateCV: 'Templates',
                colorCV: 'カラー',
                fontCV: 'フォント,
                backgroundCV: 'Background',
            }
        }
        function getVietnameseLanguage() {
            return {
                yourName : '名前',
                briefAboutYou : '自己紹介',
                phone : '電話番号',
                websiteOrLink : 'website hoặc đường dẫn',
                email : 'メール',
                location : '住所',

                experience : 'スキル',
                titleOrPosition : 'Tiêu đề hoặc vị trí',
                company : 'Công ty',
                companyDescription : '肩書き',
                datetime : '期間',
                exampleOutcomeOfActivity : 'Các kết quả đạt được khi làm việc ở đó ?',

                project : 'Dự án',
                projectOrActivity : 'Dự án',
                shortSummaryYourWork : 'Mô tả về công việc của bạn',
                exampleSuccess : 'Kết quả đạt được',

                achievements : 'Thành tích nổi bật',
                yourMostProudOf : 'Bạn tự hào gì nhất',
                aBitYourAchievement : 'Kể các thành tích đạt được',

                language : 'Ngôn ngữ',
                beginner : 'Người mới bắt đầu',

                education : 'Bằng cấp',
                degreeOrFieldStudy : 'Bằng hoặc lĩnh vực nghiên cứu',
                schoolOrUniversity: 'Trường',
                gpa: 'Điểm trung bình',

                skill: 'スキル',

                passion: '趣味',
                yourPassion: 'Sở thích của ',
                description: 'Mô tả',
                summary: '自己PR',
                summaryDescription: "Những điểm nổi bật về kinh nghiệm, kỹ năng, tính cách của bạn phù hợp với công việc. Khoảng 3-5 câu.",

                strength: '長所',
                yourUniqueTalent: 'Tên điểm mạnh',
                yourUniqueTalentDescription: 'Ứng dụng điểm mạnh vào công việc của bạn?',
                1: 'Tháng 1',
                2 : 'Tháng 2',
                3 : 'Tháng 3',
                4 : 'Tháng 4',
                5 : 'Tháng 5',
                6 : 'Tháng 6',
                7 : 'Tháng 7',
                8 : 'Tháng 8',
                9 : 'Tháng 9',
                10 : 'Tháng 10',
                11 : 'Tháng 11',
                12: 'Tháng 12',
                ongoing: 'nay',

                linkWebsiteCompany: 'Link website công ty',
                saveCV: '保存',
                download: 'Tải xuống',
                back: '戻る',
                newSections: '追加',
                rearrange: 'レイアウト変更',
                templateCV: 'テンプレート変更',
                colorCV: '文字のカラー変更',
                fontCV: '文字のフォント変更',
                backgroundCV: '',
                say: 'Tóm tắt',
                link: 'Website',
                image: '写真',
                style: '写真編集',
                facebook: 'Facebook',
                linkedin: 'Linkedin',
                tittle: 'Thành tích',
                icon: 'Icon',
                field: '',
                school: 'Trường/ Nơi đào tạo',
                GPA: 'Điểm tổng kết',
                shortSummary: 'Sơ lược công ty/công việc',
                proficiency: 'Mức độ thành thạo',
                level: 'Icon',
                shortSummaryProject: 'Lĩnh vực hoạt động',
                example: 'Mô tả công việc',
                levelSkill: 'Cấp độ',
                descriptionStrength: 'Ứng dụng thực tế',


                
            }
        }
    }]);
})();