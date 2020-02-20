<?php

namespace App\Http\Controllers;

use App\Resume;
use App\ResumeAchievement;
use App\ResumeEducation;
use App\ResumeExperience;
use App\ResumeLanguage;
use App\ResumePassion;
use App\ResumeProject;
use App\ResumeSkill;
use App\ResumeStrength;
use App\ResumeSummary;
use Illuminate\Support\Facades\Auth;


class CvApiController extends Api
{

    public function __construct()
    {
//        $this->middleware('auth');
    }
    /**
     * Create CV
     */

    public function create()
    {
        $request = request();
        $data = $request->getContent();
        $data = json_decode($data);
        $setup = $data;
        $data = $data->data;
        if ($data === null) {
            $message = 'Invalid data';
            goto LABEL_ERROR;
        }

        try {
            $resume = new Resume();
            $resume->email = $data->info->email->value;
            $resume->name = $data->info->name->value;
            $resume->phone = $data->info->phone->value;
            $resume->link = $data->info->link->value;
            $resume->description = $data->info->say->value;
            $resume->location = $data->info->location->value;
            $resume->facebook = $data->info->facebook->value;
            $resume->linkedin = $data->info->linkedin->value;
            $resume->skype = $data->info->skype->value;
            $resume->image = $data->info->image->value;
            $resume->layout = $setup->layout;
            $resume->background = $setup->background;
            $resume->font = $setup->font;
            $resume->color = $setup->color;
            $resume->number_page = $setup->numberPage;
            $resume->seeker_id = $setup->seeker_id;
            $resume->templates = implode('-',array_keys(get_object_vars($data)));


            if ($resume->image) {
                //decode base64 string
                $image = base64_decode($resume->image->base64);
                $ext = $resume->image->filename;
                $file_name = time() . '.' . $ext;
                $file_url = '/images/avatar/' . $file_name;
                $path = public_path(ltrim($file_url, '/'));
                $result = file_put_contents($path, $image);
                if ($result) {
                    $resume->image = $file_url;
                }
            }

            $resume_setting = array();
            $resume_setting['email'] = ['display' => $data->info->email->display];
            $resume_setting['say'] = ['display' => $data->info->email->display];
            $resume_setting['phone'] = ['display' => $data->info->phone->display];
            $resume_setting['link'] = ['display' => $data->info->link->display];
            $resume_setting['location'] = ['display' => $data->info->location->display];
            $resume_setting['facebook'] = ['display' => $data->info->facebook->display];
            $resume_setting['linkedin'] = ['display' => $data->info->linkedin->display];
            $resume_setting['skype'] = ['display' => $data->info->skype->display];

            $resume_setting['image'] = ['style' => $data->info->image->style, 'display' => $data->info->image->display];
            $resume_setting['height'] = $data->info->height;
            $resume->setting = json_encode($resume_setting);

            if ($resume->save()) {
                $this->saveOptions($resume, $data);
            } else {
                $message = 'Không tạo được hồ sơ';
                goto LABEL_ERROR;
            }
        } catch(\Exception $e) {
            $message = $e->getMessage();
            goto LABEL_ERROR;
        }

        return response()->json(['message' => 'CV được lưu thành công !', 'status' => 1, 'resume_id' => $resume->id]);

        LABEL_ERROR:
        return response()->json(['error' => $message]);
    }
    /**
     * Get CV
     */
    public function get($id)
    {

        if ($id <= 0) {

            $message = 'Mã CV không đúng !';
            goto LABEL_ERROR;
        }
        $data = Resume::getCVById($id);
        if(Auth::user() && Auth::user()->id != $data['seeker_id']) {
            $message = 'Mã CV không đúng !';
            goto LABEL_ERROR;
        }
        if($data) {
            return response()->json(['status' => 1, 'data' => $data]);
        }
        $message = 'CV không tồn tại !';
        LABEL_ERROR:
        return response()->json(['message' => $message, 'status' => -1]);
    }


    public function saveOptions($resume, $data) {

        // education
        if (!empty($data->education) && count($data->education->items)) {
            $count = 0;
            ResumeEducation::where('resume_id', $resume->id)->delete();
            foreach ($data->education->items as $data_education) {
                $count++;

                $education = new ResumeEducation();

                $education->resume_id = $resume->id;
                $education->name = $data->education->name;
                $education->field = $data_education->field->value;
                $education->school = $data_education->school->value;
                $education->total = $data_education->GPA->total;
                $education->rate = $data_education->GPA->rate;
                $education->field = $data_education->field->value;
                $education->date_from = $data_education->datePeriod->monthFrom . '/' . $data_education->datePeriod->yearFrom;
                $education->date_to = $data_education->datePeriod->monthTo . '/' . $data_education->datePeriod->yearTo;
                $education->on_going = $data_education->datePeriod->onGoing ? 1 : 0;

                $education_setting = array();
                $education_setting['GPA'] = ['display' => $data_education->GPA->display];
                $education_setting['school'] = ['display' => $data_education->school->display];
                $education_setting['field'] = ['display' => $data_education->field->display];


                $education_setting['height'] = $data->education->height;
                $education_setting['page'] = $data->education->page;
                $education_setting['priority'] = $data->education->priority;
                $education_setting['priority_center'] = $data->education->priority_center;
                $education_setting['position'] = $data->education->position;
                $education->setting = json_encode($education_setting);
                $education->save();

            }
        }

        // achievements
        if (!empty($data->achievements) && count($data->achievements->items)) {
            $count = 0;
            ResumeAchievement::where('resume_id', $resume->id)->delete();
            foreach ($data->achievements->items as $data_achievement) {
                $achievement = new ResumeAchievement();

                $achievement->resume_id = $resume->id;
                $achievement->name = $data->achievements->name;
                $achievement->title = $data_achievement->title->value;
                $achievement->description = $data_achievement->description->value;
                $achievement->icon = $data_achievement->icon->value;

                $achievement_setting = array();
                $achievement_setting['description'] = ['display' => $data_achievement->description->display];
                $achievement_setting['icon'] = ['display' => $data_achievement->icon->display];
                $achievement_setting['title'] = ['display' => $data_achievement->title->display];

                $achievement_setting['height'] = $data->achievements->height;
                $achievement_setting['page'] = $data->achievements->page;
                $achievement_setting['priority'] = $data->achievements->priority;
                $achievement_setting['priority_center'] = $data->achievements->priority_center;
                $achievement_setting['position'] = $data->achievements->position;
                $achievement->setting = json_encode($achievement_setting);

                $achievement->save();
            }
        }

        // languages
        if (!empty($data->languages) && count($data->languages->items)) {
            $count = 0;
            ResumeLanguage::where('resume_id', $resume->id)->delete();
            foreach ($data->languages->items as $data_language) {
                $count++;
                $language = new ResumeLanguage();

                $language->resume_id = $resume->id;
                $language->name = $data->languages->name;
                $language->language = $data_language->language;
                $language->level = (int)$data_language->level->value;
                $language->proficiency = $data_language->proficiency->value;

                $language_setting = array();
                $language_setting['level'] = ['display' => $data_language->level->display];
                $language_setting['proficiency'] = ['display' => $data_language->proficiency->display];

                $language_setting['height'] = $data->languages->height;
                $language_setting['page'] = $data->languages->page;
                $language_setting['priority'] = $data->languages->priority;
                $language_setting['priority_center'] = $data->languages->priority_center;
                $language_setting['position'] = $data->languages->position;
                $language->setting = json_encode($language_setting);

                $language->save();
            }
        }
        // experience
        if (!empty($data->experience) && count($data->experience->items)) {
            $count = 0;
            ResumeExperience::where('resume_id', $resume->id)->delete();

            foreach ($data->experience->items as $data_experience) {
                $count++;
                $experience = new ResumeExperience();

                $experience->resume_id = $resume->id;
                $experience->name = $data->experience->name;
                $experience->title = $data_experience->title;
                $experience->company = $data_experience->company->value;
                $experience->location = $data_experience->location->value;
                $experience->short_summary = $data_experience->shortSummary->value;
                $experience->date_from = $data_experience->datePeriod->monthFrom . '/' . $data_experience->datePeriod->yearFrom;
                $experience->date_to = $data_experience->datePeriod->monthTo . '/' . $data_experience->datePeriod->yearTo;
                $experience->on_going = (int) $data_experience->datePeriod->onGoing;
                $experience->description = json_encode($data_experience->example->data);
                $experience->ordering = $count;

                $experience_setting = array();
                $experience_setting['location'] = ['display' => $data_experience->location->display];
                $experience_setting['datePeriod'] = ['display' => $data_experience->datePeriod->display];
                $experience_setting['example'] = ['display' => $data_experience->example->display];
                $experience_setting['shortSummary'] = ['display' => $data_experience->shortSummary->display];

                $experience_setting['height'] = $data->experience->height;
                $experience_setting['page'] = $data->experience->page;
                $experience_setting['priority'] = $data->experience->priority;
                $experience_setting['priority_center'] = $data->experience->priority_center;
                $experience_setting['position'] = $data->experience->position;
                $experience->setting = json_encode($experience_setting);

                $experience->save();
            }
        }

        // project
        if (!empty($data->project) && count($data->project->items)) {
            $count = 0;
            Resumeproject::where('resume_id', $resume->id)->delete();
            foreach ($data->project->items as $data_project) {
                $count++;
                $project = new Resumeproject();

                $project->resume_id = $resume->id;
                $project->name = $data->project->name;
                $project->title = $data_project->title;
                $project->link = $data_project->link->value;
                $project->location = $data_project->location->value;
                $project->short_summary = $data_project->shortSummary->value;
                $project->date_from = $data_project->datePeriod->monthFrom . '/' . $data_project->datePeriod->yearFrom;
                $project->date_to = $data_project->datePeriod->monthTo . '/' . $data_project->datePeriod->yearTo;
                $project->on_going = (int) $data_project->datePeriod->onGoing;
                $project->description = json_encode($data_project->example->data);
                $project->ordering = $count;

                $project_setting = array();
                $project_setting['location'] = ['display' => $data_project->location->display];
                $project_setting['datePeriod'] = ['display' => $data_project->datePeriod->display];
                $project_setting['shortSummary'] = ['display' => $data_project->shortSummary->display];
                $project_setting['example'] = ['display' => $data_project->example->display];

                $project_setting['height'] = $data->project->height;
                $project_setting['page'] = $data->project->page;
                $project_setting['priority'] = $data->project->priority;
                $project_setting['priority_center'] = $data->project->priority_center;
                $project_setting['position'] = $data->project->position;
                $project->setting = json_encode($project_setting);

                $project->save();
            }
        }
        // skill
        if (!empty($data->skill) && count($data->skill->items)) {
            $count = 0;
            Resumeskill::where('resume_id', $resume->id)->delete();
            foreach ($data->skill->items as $data_skill) {
                $skill = new Resumeskill();

                $skill->resume_id = $resume->id;
                $skill->name = $data->skill->name;
                $skill->skill = $data_skill->name;
                $skill->level = $data_skill->level->value;

                $skill_setting = array();
                $skill_setting['level'] = ['display' => $data_skill->level->display];

                $skill_setting['height'] = $data->skill->height;
                $skill_setting['page'] = $data->skill->page;
                $skill_setting['priority'] = $data->skill->priority;
                $skill_setting['priority_center'] = $data->skill->priority_center;
                $skill_setting['position'] = $data->skill->position;
                $skill->setting = json_encode($skill_setting);

                $skill->save();
            }
        }

        // summary
        if (!empty($data->summary)) {
            Resumeskill::where('resume_id', $resume->id)->delete();
            $summary = new Resumesummary();

            $summary->resume_id = $resume->id;
            $summary->name = $data->summary->name;
            $summary->summary = $data->summary->value;

            $summary_setting = array();

            $summary_setting['height'] = $data->summary->height;
            $summary_setting['page'] = $data->summary->page;
            $summary_setting['priority'] = $data->summary->priority;
            $summary_setting['priority_center'] = $data->summary->priority_center;
            $summary_setting['position'] = $data->summary->position;
            $summary->setting = json_encode($summary_setting);

            $summary->save();

        }

        // strength
        if (!empty($data->strength) && count($data->strength->items)) {
            $count = 0;
            Resumestrength::where('resume_id', $resume->id)->delete();
            foreach ($data->strength->items as $data_strength) {
                $strength = new Resumestrength();

                $strength->resume_id = $resume->id;
                $strength->name = $data->strength->name;
                $strength->title = $data_strength->name;
                $strength->description = $data_strength->description->value;
                $strength->icon = $data_strength->icon->value;

                $strength_setting = array();
                $strength_setting['description'] = ['display' => $data_strength->description->display];
                $strength_setting['icon'] = ['display' => $data_strength->icon->display];

                $strength_setting['height'] = $data->strength->height;
                $strength_setting['page'] = $data->strength->page;
                $strength_setting['priority'] = $data->strength->priority;
                $strength_setting['priority_center'] = $data->strength->priority_center;
                $strength_setting['position'] = $data->strength->position;
                $strength->setting = json_encode($strength_setting);

                $strength->save();
            }
        }

        // passion
        if (!empty($data->passion) && count($data->passion->items)) {
            $count = 0;
            Resumepassion::where('resume_id', $resume->id)->delete();
            foreach ($data->passion->items as $data_passion) {
                $passion = new Resumepassion();

                $passion->resume_id = $resume->id;
                $passion->name = $data->passion->name;
                $passion->passion = $data_passion->name;
                $passion->description = $data_passion->description->value;
                $passion->icon = $data_passion->icon->value;

                $passion_setting = array();
                $passion_setting['description'] = ['display' => $data_passion->description->display];
                $passion_setting['icon'] = ['display' => $data_passion->icon->display];

                $passion_setting['height'] = $data->passion->height;
                $passion_setting['page'] = $data->passion->page;
                $passion_setting['priority'] = $data->passion->priority;
                $passion_setting['priority_center'] = $data->passion->priority_center;
                $passion_setting['position'] = $data->passion->position;
                $passion->setting = json_encode($passion_setting);

                $passion->save();
            }
        }
    }
    /**
     * Update CV
     */
    public function update($id)
    {
        $id = (int) $id;
        if ($id <= 0) {
            $message = 'Invalid ID';
            goto LABEL_ERROR;
        }

        $request = request();
        $data = $request->getContent();
        $data = json_decode($data);
        $setup = $data;
        $data = $data->data;

        if ($data === null) {
            $message = 'Invalid data';
            goto LABEL_ERROR;
        }


        $resume = Resume::findOrFail($id);

        if ($resume) {

            $resume->email = $data->info->email->value;

            $resume->name = $data->info->name->value;
            $resume->phone = $data->info->phone->value;
            $resume->link = $data->info->link->value;
            $resume->image = $data->info->image->value;

            if ($resume->image && is_object($resume->image)) {
                //decode base64 string
                $image = base64_decode($resume->image->base64);
                $ext = $resume->image->filename;
                $file_name = time() . '.' . $ext;
                $file_url = '/images/avatar/' . $file_name;
                $path = public_path(ltrim($file_url, '/'));
                $result = file_put_contents($path, $image);
                if ($result) {
                    $resume->image = $file_url;
                }
            }

            $resume->description = $data->info->say->value;
            $resume->location = $data->info->location->value;
            $resume->facebook = $data->info->facebook->value;
            $resume->skype = $data->info->skype->value;
            $resume->linkedin = $data->info->linkedin->value;

            $resume->layout = $setup->layout;
            $resume->background = $setup->background;
            $resume->font = $setup->font;
            $resume->color = $setup->color;
            $resume->number_page = $setup->numberPage;
            $resume->seeker_id = $setup->seeker_id;
            $resume->templates = implode('-',array_keys(get_object_vars($data)));

            $resume_setting = array();
            $resume_setting['email'] = ['display' => $data->info->email->display];
            $resume_setting['say'] = ['display' => $data->info->email->display];
            $resume_setting['phone'] = ['display' => $data->info->phone->display];
            $resume_setting['link'] = ['display' => $data->info->link->display];
            $resume_setting['facebook'] = ['display' => $data->info->facebook->display];
            $resume_setting['linkedin'] = ['display' => $data->info->linkedin->display];
            $resume_setting['skype'] = ['display' => $data->info->skype->display];
            $resume_setting['height'] = $data->info->height;

            $resume_setting['location'] = ['display' => $data->info->location->display];
            $resume_setting['image'] = ['style' => $data->info->image->style, 'display' => $data->info->image->display];
            $resume->setting = json_encode($resume_setting);

            if ($resume->save()) {
                $this->saveOptions($resume, $data);
            } else {
                $message = 'Không cập nhật được hồ sơ';
                goto LABEL_ERROR;
            }
        } else {
            $message = 'CV không tồn tại';
            goto LABEL_ERROR;
        }

        return response()->json(['message' => 'CV được cập nhật thành công !', 'status' => 1, 'resume_id' => $resume->id]);

        LABEL_ERROR:
        return response()->json(['error' => $message]);
    }
}
