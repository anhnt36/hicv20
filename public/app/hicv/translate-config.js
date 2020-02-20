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
                yourName : 'YOUR NAME',
                briefAboutYou : 'You in a word and two',
                phone : 'Phone',
                websiteOrLink : 'Website/Link',
                email : 'Email',
                location : 'Location',

                experience : 'Experience',
                titleOrPosition : 'Title/Position',
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

                skill: 'Skill',

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
                back: 'Back',
                newSections: 'New Sections',
                rearrange: 'Rearrange/Edit',
                templateCV: 'Templates',
                colorCV: 'Colors',
                fontCV: 'Fonts',
                backgroundCV: 'Background',
            }
        }
        function getVietnameseLanguage() {
            return {
                yourName : 'Họ và tên',
                briefAboutYou : 'Tóm tắt về bạn',
                phone : 'Số điện thoại',
                websiteOrLink : 'website hoặc đường dẫn',
                email : 'Email',
                location : 'Nơi ở hiện tại',

                experience : 'Kinh nghiệm',
                titleOrPosition : 'Tiêu đề hoặc vị trí',
                company : 'Công ty',
                companyDescription : 'Nhiệm vụ',
                datetime : 'Thời gian làm việc',
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

                skill: 'Kỹ năng',

                passion: 'Sở thích',
                yourPassion: 'Sở thích của bạn',
                description: 'Mô tả',
                summary: 'Tóm tắt về bạn',
                summaryDescription: "Những điểm nổi bật về kinh nghiệm, kỹ năng, tính cách của bạn phù hợp với công việc. Khoảng 3-5 câu.",

                strength: 'Điểm mạnh',
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
                saveCV: 'Lưu CV',
                download: 'Tải xuống',
                back: 'Quay lại',
                newSections: 'Thêm mục',
                rearrange: 'Thay đổi bố cục',
                templateCV: 'Thay đổi mẫu CV',
                colorCV: 'Thay đổi màu chữ',
                fontCV: 'Thay đổi font chữ',
                backgroundCV: 'Thay đổi nền CV',
                say: 'Tóm tắt',
                link: 'Website',
                image: 'Ảnh đại diện',
                style: 'Chỉnh ảnh',
                facebook: 'Facebook',
                linkedin: 'Linkedin',
                tittle: 'Thành tích',
                icon: 'Icon',
                field: 'Ngành học',
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