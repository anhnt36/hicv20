<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    public function achievements()
    {
        return $this->hasMany('App\ResumeAchievement');
    }

    public function educations()
    {
        return $this->hasMany('App\ResumeEducation');
    }

    public function experiences()
    {
        return $this->hasMany('App\ResumeExperience');
    }

    public function interests()
    {
        return $this->hasMany('App\ResumeInterest');
    }

    public function languages()
    {
        return $this->hasMany('App\ResumeLanguage');
    }

    public function projects()
    {
        return $this->hasMany('App\ResumeProject');
    }

    public function skills()
    {
        return $this->hasMany('App\ResumeSkill');
    }
    public function summary()
    {
        return $this->hasOne('App\ResumeSummary');
    }

    public function strengths()
    {
        return $this->hasMany('App\ResumeStrength');
    }
    public function passions()
    {
        return $this->hasMany('App\ResumePassion');
    }

    public static function getCVById($id) {

        $resume = self::find($id);

        if ($resume) {

            $dataGeneralTemplate = ['height', 'page', 'position', 'priority', 'priority_center'];
            $data = array();
            $templates = explode('-',$resume->templates);

            $results = [
                'layout'        => $resume['layout'],
                'background'    => $resume['background'],
                'font'          => $resume['font'],
                'color'         => $resume['color'],
                'numberPage'    => $resume['number_page'],
                'seeker_id'    => $resume['seeker_id'],
            ];

            // thông tin chung
            $data['info'] = [
                'name' => ['value' => $resume['name']],
                'say' => ['value' => $resume['description']],
                'phone' => ['value' => $resume['phone']],
                'email' => ['value' => $resume['email']],
                'link' => ['value' => $resume['link']],
                'facebook' => ['value' => $resume['facebook']],
                'skype' => ['value' => $resume['skype']],
                'linkedin' => ['value' => $resume['linkedin']],
                'location' => ['value' => $resume['location']],
                'image' => ['value' => $resume['image']]
            ];
            $setting = json_decode($resume['setting'], true);
            $data['info'] = array_merge_recursive($data['info'], $setting);

            // thành tích
            if(in_array('achievements', $templates)) {
                $achievements = $resume->achievements()->orderBy('ordering')->get();
                if (count($achievements)) {
                    $arr_achievement = array();
                    foreach ($achievements as $achievement) {
                        $data_achievement = [
                            'id' => $achievement['id'],
                            'title' => ['value' => $achievement['title']],
                            'description' => ['value' => $achievement['description']],
                            'icon' => ['value' => $achievement['icon']],
                        ];
                        $setting = json_decode($achievement['setting'], true);
                        $data_achievement = array_merge_recursive($data_achievement, $setting);
                        $arr_achievement[] = $data_achievement;
                    }
                    $data['achievements']['items'] = $arr_achievement;
                    $data['achievements']['name'] = $achievements[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['achievements'][$attr] = $setting[$attr];
                    }
                }
            }


            // đào tạo
            if(in_array('education', $templates)) {
                $educations = $resume->educations()->orderBy('id')->get();

                if (count($educations)) {
                    $arr_education = array();
                    foreach ($educations as $education) {
                        $data_education = [
                            'id' => $education['id'],
                            'school' => ['value' => $education['school']],
                            'field' => ['value' => $education['field']],
                            'GPA' => [
                                'rate' => $education['rate'],
                                'total' => $education['total']
                            ],
                            'datePeriod' => [
                                'monthFrom' => explode('/',$education['date_from'])[0],
                                'yearFrom' => explode('/',$education['date_from'])[1],
                                'monthTo' => explode('/',$education['date_to'])[0],
                                'yearTo' => explode('/',$education['date_to'])[1],
                                'onGoing' => (bool) $education['on_going'],
                            ]
                        ];
                        $setting = json_decode($education['setting'], true);
                        $data_education = array_merge_recursive($data_education, $setting);
                        $arr_education[] = $data_education;
                    }
                    $data['education']['items'] = $arr_education;
                    $data['education']['name'] = $educations[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['education'][$attr] = $setting[$attr];
                    }
                }
            }


            // kinh nghiệm
            if(in_array('experience', $templates)) {
                $experiences = $resume->experiences()->orderBy('ordering')->get();
                if (count($experiences)) {
                    $arr_experience = array();
                    foreach ($experiences as $experience) {
                        $data_experience = [
                            'id' => $experience['id'],
                            'company' => ['value' => $experience['company']],
                            'title' => $experience['title'],
                            'name' => ['value' => $experience['name']],
                            'location' => ['value' => $experience['location']],
                            'shortSummary' => ['value' => $experience['location']],
                            'datePeriod' => [
                                'monthFrom' => explode('/',$experience['date_from'])[0],
                                'yearFrom' => explode('/',$experience['date_from'])[1],
                                'monthTo' => explode('/',$experience['date_to'])[0],
                                'yearTo' => explode('/',$experience['date_to'])[1],
                                'onGoing' => (bool) $experience['on_going'],
                            ],
                            'example' => ['data' => json_decode($experience['description'])]
                        ];
                        $setting = json_decode($experience['setting'], true);
                        $data_experience = array_merge_recursive($data_experience, $setting);
                        $arr_experience[] = $data_experience;
                    }
                    $data['experience']['items'] = $arr_experience;
                    $data['experience']['name'] = $experiences[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['experience'][$attr] = $setting[$attr];
                    }
                }
            }

            // du an
            if(in_array('project', $templates)) {
                $projects = $resume->projects()->orderBy('ordering')->get();
                if (count($projects)) {
                    $arr_project = array();
                    foreach ($projects as $project) {
                        $data_project = [
                            'id' => $project['id'],
                            'shortSummary' => ['value' => $project['short_summary']],
                            'name' => ['value' => $project['name']],
                            'title' => $project['title'],
                            'link'  => ['value' => $project['link']],
                            'location' => ['value' => $experience['location']],
                            'datePeriod' => [
                                'monthFrom' => explode('/',$project['date_from'])[0],
                                'yearFrom' => explode('/',$project['date_from'])[1],
                                'monthTo' => explode('/',$project['date_to'])[0],
                                'yearTo' => explode('/',$project['date_to'])[1],
                                'onGoing' => (bool) $project['on_going'],
                            ],
                            'example' => ['data' => json_decode($project['description'])]
                        ];
                        $setting = json_decode($project['setting'], true);
                        $data_project = array_merge_recursive($data_project, $setting);
                        $arr_project[] = $data_project;
                    }
                    $data['project']['items'] = $arr_project;
                    $data['project']['name'] = $projects[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['project'][$attr] = $setting[$attr];
                    }
                }
            }

            // ngoại ngữ
            if(in_array('languages', $templates)) {
                $languages = $resume->languages()->orderBy('ordering')->get();
                if (count($languages)) {
                    $arr_language = array();
                    foreach ($languages as $language) {
                        $data_language = [
                            'id' => $language['id'],
                            'language' => $language['language'],
                            'level' => ['value' => $language['level']],
                            'proficiency' => ['value' => $language['proficiency']],
                        ];
                        $setting = json_decode($language['setting'], true);
                        $data_language = array_merge_recursive($data_language, $setting);
                        $arr_language[] = $data_language;
                    }
                    $data['languages']['items'] = $arr_language;
                    $data['languages']['name'] = $languages[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['languages'][$attr] = $setting[$attr];
                    }
                }
            }


            // kỹ năng
            if(in_array('skill', $templates)) {
                $skills = $resume->skills()->orderBy('ordering')->get();
                if (count($skills)) {
                    $arr_skill = array();
                    foreach ($skills as $skill) {
                        $data_skill = [
                            'id' => $skill['id'],
                            'name' => $skill['skill'],
                            'level' => ['value' => $skill['level']],
                        ];
                        $setting = json_decode($skill['setting'], true);
                        $data_skill = array_merge_recursive($data_skill, $setting);
                        $arr_skill[] = $data_skill;
                    }
                    $data['skill']['items'] = $arr_skill;
                    $data['skill']['name'] = $skills[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['skill'][$attr] = $setting[$attr];
                    }
                }
            }

            // Tóm tắt
            if (in_array('summary', $templates)) {
                $summary = $resume->summary()->get();
                $arr_summary = array();
                $data_summary = [
                    'id' => $summary[0]['id'],
                    'value'   => $summary[0]['summary'],
                    'name'      => $summary[0]['name'],
                ];
                $setting = json_decode($summary[0]['setting'], true);
                $data_summary = array_merge_recursive($data_summary, $setting);
                $data['summary'] = $data_summary;
            }

            // strength
            if(in_array('strength', $templates)) {
                $strengths = $resume->strengths()->orderBy('id')->get();
                if (count($strengths)) {
                    $arr_strength = array();
                    foreach ($strengths as $strength) {
                        $data_strength = [
                            'id' => $strength['id'],
                            'name' => $strength['title'],
                            'description' => ['value' => $strength['description']],
                            'icon' => ['value' => $strength['icon']],
                        ];
                        $setting = json_decode($strength['setting'], true);
                        $data_strength = array_merge_recursive($data_strength, $setting);
                        $arr_strength[] = $data_strength;
                    }
                    $data['strength']['items'] = $arr_strength;
                    $data['strength']['name'] = $strengths[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['strength'][$attr] = $setting[$attr];
                    }
                }
            }

            // passion
            if(in_array('passion', $templates)) {
                $passions = $resume->passions()->orderBy('id')->get();
                if (count($passions)) {
                    $arr_passion = array();
                    foreach ($passions as $passion) {
                        $data_passion = [
                            'id' => $passion['id'],
                            'name' => $passion['passion'],
                            'description' => ['value' => $passion['description']],
                            'icon' => ['value' => $passion['icon']],
                        ];
                        $setting = json_decode($passion['setting'], true);
                        $data_passion = array_merge_recursive($data_passion, $setting);
                        $arr_passion[] = $data_passion;
                    }
                    $data['passion']['items'] = $arr_passion;
                    $data['passion']['name'] = $passions[0]['name'];
                    foreach($dataGeneralTemplate as $attr) {
                        $data['passion'][$attr] = $setting[$attr];
                    }
                }
            }
            $results['data'] = $data;
            return $results;
        } else {
            return false;
        }
    }
}
