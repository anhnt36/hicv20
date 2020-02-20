<?php

namespace App\Http\Controllers;

use App\Resume;
use mikehaertl\wkhtmlto\Pdf;

class PdfApiController extends Api
{
    public $dataCV;

    public $layout = [
        'fonts' => [
            'lato' => 'Lato',
            'raleway' => 'Raleway',
        ],
        'colors' => [
            'blue' =>'#008CFF',
            'green' => '#00B400'
        ],
        'backgrounds' => [
            'default' => '557025919b54a31e81ae82037c8374ec.jpg',
            'lp'        => 'f5a28bd0fefbdea27138370e0d0ab333.svg',
            'wa' =>'ead763d98973496998476ba2d5b6b5b4.svg',
            'to' => 'f3e35038ab52f56f3a389234aea10fdc.svg',
        ]
    ];

    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Convert html to pdf.
     */
    public function convert_pdf($id)
    {
        $id = (int) $id;
        if (empty($id) || $id <= 0) {
            $message = 'Invalid ID';
            goto LABEL_ERROR;
        }
        $cv = Resume::getCVById($id);

        $this->dataCV = $cv;
        $html = '';
        $data_tmp = [];
        $data_tmp_info = $cv['data']['info'];
        $pdfConfig = array(
            'encoding' => 'UTF-8',
            'no-outline',
            'margin-top'    => 0,
            'margin-right'  => 0,
            'margin-bottom' => 0,
            'margin-left'   => 0,
            'enable-smart-shrinking',
            'dpi'			=> 125,
            'ignoreWarnings'=>true
        );
        $pdf = new Pdf($pdfConfig);
        $height = 0;
        if($cv['layout'] == 'double') {
            foreach($cv['data'] as $key => $template) {
                if($key == 'info') continue;
                $template['priority'] = (int)$template['priority'];
                $data_tmp[(int)$template['page']][$template['position']][$key] = $template;
            }
            foreach($data_tmp as $key => $templateGroup) {
                foreach($templateGroup as $key2 => $float) {
                    $data_tmp[$key][$key2] = array_sort($float, function($value){
                        return $value['priority'];
                    }, SORT_ASC);
                }
            }
            foreach($data_tmp as $key1 => $templateGroup) {

                $html .= "<div class=\"resume-renderer-page browser-resume-page\">
                            <div class='resume-background-wrapper' style=\"background-image: url(" . asset('/images/backgrounds/' . $this->layout['backgrounds'][$cv['background']]) . ")\"></div>
                            <div class=\"resume-page-wrapper\" class=\"resume-background-wrapper\" src=\"background-image: url(" . asset('/images/backgrounds/' . $this->layout['backgrounds'][$cv['background']]) . ")\">";
                    if ($key1 == 1) $html .= $this->getHtmlInfo($data_tmp_info);

                    //right of page
                    $html .= "<div class=\"resume-renderer-two-column\" style=\"width: 60% !important; padding-right: 15px\">";

                        $leftHtml = '';
                        if(!empty($templateGroup['left'])) {
                            foreach ($templateGroup["left"] as $leftKey => $template) {
                                $function = 'getHtml' . ucfirst($leftKey);

                                $leftHtml .= $this->{$function}($template);
                            }
                        }
                        $html = $html . $leftHtml;
                    $html .= "</div>";

                    //left of page
                    $html .= "<div class=\"resume-renderer-two-column\" style=\"width: 40% !important;\">";

                        $rightHtml = '';
                        if(!empty($templateGroup['right'])) {
                            foreach ($templateGroup["right"] as $rightKey => $template) {
                                $function = 'getHtml' . ucfirst($rightKey);
                                $rightHtml .= $this->{$function}($template);
                            }
                        }
                        $html = $html . $rightHtml;

                    $html .= "</div>";

                $html .= "</div></div>";
            }
        }
        else {
            foreach($cv['data'] as $key => $template) {

                $height += $template['height'];
                if($key == 'info') continue;
                $template['priority_center'] = (int)$template['priority_center'];
                $data_tmp[$key] = $template;

            }
            $data_tmp = array_sort($data_tmp, function($value, $key){

                    return $value['priority_center'];
                }, SORT_DESC);

            $height += 150;
            $height = ceil($height/940) * 940;

            $html .= "<div class=\"resume-renderer-page browser-resume-page\" style=\"height: {$height}px\">
                            <div class='resume-background-wrapper' style=\"background-image: url(" . asset('/images/backgrounds/' . $this->layout['backgrounds'][$cv['background']]) . ")\"></div>
                            <div class=\"resume-page-wrapper\">";
                $html .= $this->getHtmlInfo($data_tmp_info);

                //right of page
                $html .= "<div class=\"resume-renderer-one-column\" style=\"padding-right: 15px\">";

                $leftHtml = '';
                if(!empty($data_tmp)) {
                    foreach ($data_tmp as $leftKey => $template) {
                        $function = 'getHtml' . ucfirst($leftKey);

                        $leftHtml .= $this->{$function}($template);
                    }
                }
                $html = $html . $leftHtml;
                $html .= "</div>";

                $html .= "</div></div>";

        }
        $html = $this->getHtmlGeneral($html, $cv);
//        var_dump($html);die();
        $pdf->addPage($html);
        $pdf->binary = '/usr/local/bin/wkhtmltopdf';
        $file_name = md5(mt_rand()) . '.pdf';
        $file_path = public_path() . '/pdf/' . $file_name;

        $file_url = url('/pdf/' . $file_name);
        if (!$pdf->saveAs($file_path)) {
            return response()->json(['error' => $pdf->getError(), 'message' => 'Tải CV bị lỗi !', 'status' => -1]);
        } else {
            return response()->json(['file' => $file_url, 'message' => 'Tải CV thành công !', 'status' => 1]);
        }
        LABEL_ERROR:
        return response()->json(['message' => $message, 'status' => -1]);
    }

    public function getHtmlGeneral($html, $data) {
        $style = "";
        if(!empty($data['data']['skill'])) {
            if($data['data']['skill']['position'] == 'left') {
                $style .= ".SkillSection .rz-ceil {
                            left: 190px !important;
                        }";
            } else {
                $style .= ".SkillSection .rz-ceil {
                            left: 280px !important;
                        }";
            }
        }
        $html = "
            <html xmlns=\"http://www.w3.org/1999/xhtml\">
            <head>
                <title>Hi-CV</title>
                <meta name=\"viewport\" content=\"initial-scale=1.0, user-scalable=no\" />
                <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
                <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CRoboto:300,400,700%7CLato:400,700,800%7CPlayfair+Display:400,700%7CAbril+Fatface%7CRaleway:300,400,600,700%7CMontserrat:400,700%7CExo+2:400,600%7COswald:300,400,700%7CChivo%7CRoboto+Slab:400,700&amp;subset=latin,cyrillic-ext,latin-ext,cyrillic,latin,cyrillic-ext,latin-ext,cyrillic,latin,cyrillic-ext,latin-ext,cyrillic,latin,latin-ext,cyrillic,latin,latin-ext,latin,latin-ext,latin,latin,latin-ext,cyrillic,latin,latin-ext,latin,latin,cyrillic-ext,latin-ext,cyrillic\" media=\"all\">
                <link rel=\"stylesheet\" href=\"" . asset('bower_components/bootstrap/dist/css/bootstrap.min.css') . "\">
                <link rel=\"stylesheet\" href=\"" . asset('css/main.css') . "\">
                <link rel=\"stylesheet\" href=\"" . asset('css/style1.css') . "\">
                <link rel=\"stylesheet\" href=\"" . asset('bower_components/font-awesome/css/font-awesome.min.css') . "\">
                <link rel=\"stylesheet\" href=\"" . asset('bower_components/angular-bootstrap/ui-bootstrap-csp.css') . "\">
                <link rel=\"stylesheet\" href=\"" . asset('bower_components/angularjs-slider/dist/rzslider.min.css') . "\">
                <style>
                    * {margin:0; padding:0}
                    
                    .resume-renderer {
                        width: 940px;
                        overflow: hidden;
                        overflow-x: hidden;
                        display: block !important;
                       

                    }
                   
                    .resume-renderer-page  {
                        width: 940px;
                        height: 1329px;
                        overflow-x: hidden;
                        overflow-y: hidden;
                        margin-bottom: 0px;
                    
                    }
                   
                    .next-page {
                        page-break-after: always;
                    }
                    body, html {
                        width: 940px;
                        overflow-x: hidden;
                        background-color: none;
                        font-weight: 400;
                    }
                    .with-icon-container {
                            float: left;
                            display: inline-block;
                            width: 100%;
                    }
                    .resume-header-with-photo .with-icon {
                        width: 49% !important;
                        display: inline-block;
                    }
                    .inline-block {
                        display: inline-block;
                        margin-bottom: -3px;
                    }
                    #resume-null .resume-first-color {
                                        color: #000000 !important;
                                    }

                                    #resume-null .resume-first-color::-webkit-input-placeholder,
                                    #resume-null .resume-first-color input::-webkit-input-placeholder {
                                        color: #000000 !important;
                                    }

                                    #resume-null .resume-first-color:-moz-placeholder,
                                    #resume-null .resume-first-color input:-moz-placeholder {
                                        color: #000000 !important;
                                    }

                                    #resume-null .resume-first-color::-moz-placeholder,
                                    #resume-null .resume-first-color input::-moz-placeholder {
                                        color: #000000 !important;
                                    }

                                    #resume-null .resume-first-color:-ms-input-placeholder,
                                    #resume-null .resume-first-color input:-ms-input-placeholder {
                                        color: #000000 !important;
                                    }

                                    #resume-null .resume-first-background {
                                        background-color: #000000 !important;
                                    }

                                    #resume-null .resume-before-first-background::before {
                                        background-color: #000000 !important;
                                    }

                                    #resume-null .resume-first-border {
                                        border-color: #000000 !important;
                                    }

                                    #resume-null .resume-first-fill {
                                        fill: #000000 !important;
                                    }

                                    #resume-null .resume-first-stroke {
                                        stroke: #000000 !important;
                                    }

                                    #resume-null .resume-second-color {
                                        color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-color::-webkit-input-placeholder,
                                    #resume-null .resume-second-color input::-webkit-input-placeholder {
                                        color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-color:-moz-placeholder,
                                    #resume-null .resume-second-color input:-moz-placeholder {
                                        color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-color::-moz-placeholder,
                                    #resume-null .resume-second-color input::-moz-placeholder {
                                        color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-color:-ms-input-placeholder,
                                    #resume-null .resume-second-color input:-ms-input-placeholder {
                                        color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-background {
                                        background-color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-before-second-background::before {
                                        background-color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-border {
                                        border-color: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-fill {
                                        stroke: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-second-stroke {
                                        stroke: {$this->layout['colors'][$data['color']]} !important;
                                    }

                                    #resume-null .resume-heading-font {
                                        font-family: \"{{$this->layout['fonts'][$data['font']]}}\", Arial, Helvetica, sans-serif !important;
                                    }
                                    .page-break-before {
                                        page-break-before: auto;
                                    }
                    {$style}
                </style>
            </head>
            <body>
                <div id=\"resume-null\" class=\"resume-renderer resume-body-font center-resume\">
                    <div>
                        {$html}
                    </div>
                </div>
            </body>
            </html>";
        return $html;
    }

    public function getHtmlInfo($data) {
        $styleImage = $data['image']['style'] == 1 ? 'photo-rect' : 'photo-round';
        $image = asset($data['image']['value']);
        $html = "<div class=\"clickable\">
                    <div class=\"resume-header resume-header-with-photo editable\" style=\"page-break-after:always;\">
                        <div class=\"resume-header-col resume-header-col-left\">
                            <div class=\"editable-field-wrapper\">
                                <textarea class=\"editable-field name resume-heading-font resume-first-color uppercase-name\" rows=\"1\" style=\"overflow: hidden; word-wrap: break-word; height: 50px;\">{$data['name']['value']}</textarea>
                            </div>
                            <span>
                                <div class=\"editable-field-wrapper\">
                                    <textarea class=\"editable-field title resume-heading-font resume-second-color\" rows=\"1\"
                                              style=\"overflow: hidden; word-wrap: break-word; height: 25px;\">{$data['say']['value']}</textarea>
                                </div>
                            </span>

                            <div class=\"with-icon-container top-sm\">
                                <div class=\"with-icon\"><i class=\"fa fa-phone resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea class=\"editable-field\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['phone']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon\"><i class=\"fa fa-at resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea class=\"editable-field\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['email']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon url-link \"><i class=\"fa fa-link resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea class=\"editable-field\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['link']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon\"><i class=\"fa fa-map-marker resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea class=\"editable-field\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['location']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon\"><i
                                        class=\"fa fa-facebook-square resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea msd-elastic
                                                  class=\"editable-field\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['facebook']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon\"><i class=\"fa fa-linkedin-square resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea msd-elastic
                                                  class=\"editable-field\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['linkedin']['value']}</textarea>
                                    </div>
                                </div>
                                <div class=\"with-icon\"><i
                                        class=\"fa fa-skype resume-second-color width15\"></i>&nbsp;&nbsp;
                                    <div class=\"editable-field-wrapper inline-block\">
                                        <textarea msd-elastic
                                                  class=\"editable-field\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 16px;\">{$data['skype']['value']}</textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div  class=\"resume-header-col resume-header-col-right photo-container\">
                            <div style=\"background-image:url($image);\"
                                 class=\"photo editable {$styleImage}\">
                            </div>
                        </div>
                        <div class=\"clearfix\"></div>
                    </div>
                </div>";
        return $html;
    }

    public function getHtmlEducation($data) {
        $html = "<div id=\"EducationSection\" class=\"resume-section EducationSection\">
                <div class=\"resume-section-container clickable editable\">
                    <div class=\"resume-section-text-container\">
                        <div class=\"editable-field-wrapper\">
                            <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                      placeholder=\"\"
                                      autocomplete=\"off\"
                                      rows=\"1\"
                                      style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                        </div>
                    </div>
                </div>
                <div class=\"resume-section\">
                    <div >
                        <div class=\"resume-item-holder line-item clickable editable\" id=\"sections-3-items-0\">";
                            foreach ($data['items'] as $item) {
                                $html .= "
                            <div class=\"item-object education-item\">
                                <div class=\"inner\">
                                    <div class=\"education-item-not-gpa\">
                                        <div class=\"editable-field-wrapper\">
                                            <textarea class=\"editable-field item-degree resume-first-color resume-heading-font\"
                                                      placeholder=\"\"
                                                      style=\"overflow: hidden; word-wrap: break-word; height: 25px;\">{$item['field']['value']}</textarea>
                                        </div>
                                        <div class=\"editable-field-wrapper\">
                                            <textarea class=\"editable-field item-institution resume-second-color\"
                                                      placeholder=\"\"
                                                      style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['school']['value']}</textarea>
                                        </div>
                                        <div class=\"with-icon-container top-xty\">
                                            <a href=\"\" role=\"button\" class=\"btn btn-sm btn-resume-data btn-link with-icon\">
                                                <i class=\"icon icon-40-free-calendar\"></i>
                                                <span>{$item['datePeriod']['monthFrom']}</span>&nbsp;
                                                <span>{$item['datePeriod']['yearFrom']}</span>&nbsp;
                                                <span>{$item['datePeriod']['monthTo']}</span>&nbsp;
                                                <span>{$item['datePeriod']['yearTo']}</span>&nbsp;
                                            </a>
                                        </div>
                                    </div>
                                    <div class=\"education-item-gpa-container\">
                                        <div class=\"education-item-gpa\">
                                            <h4 class=\"education-item-gpa-title\"></h4>
                                            <div>
                                                <input class=\"editable-field bold resume-second-color\" value=\"{$item['GPA']['rate']}\">
                                                <span class=\"separator\"> / </span>
                                                <input class=\"editable-field\" value=\"{$item['GPA']['total']}\"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }

        $html .= "
                        </div>
                    </div>
                </div>
            </div>";
        return $html;
    }


    public function getHtmlAchievements($data) {

        $html = "<div id=\"AchievementSection\" class=\"resume-section AchievementSection\">
                    <div class=\"resume-section-container clickable editable\">
                        <div class=\"resume-section-text-container\">
                            <div class=\"editable-field-wrapper\">
                                <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                          placeholder=\"\"
                                          style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class=\"resume-section\">
                        <div>";
                        foreach ($data['items'] as $item) {
                            $html .= "<div class=\"resume-item-holder line-item editable clickable\" id=\"sections-1-items-0\">
                                <div class=\"item-object achievement-item\">
                                    <div class=\"inner\">
                                        <div class=\"achievement-item-content\">
                                            <div class=\"achievement-item-icon resume-second-color editable\">
                                                <div class=\"\" icon=\"139-free-diamond-01\">
                                                    <i class=\"icon resume-second-color icon-139-free-diamond-01\"></i>
                                                </div>
                                            </div>

                                            <div class=\"editable-field-wrapper\">
                                                <textarea class=\"editable-field achievement-item-title resume-first-color\"
                                                          placeholder=\"\"
                                                          style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['title']['value']}</textarea>
                                            </div>
                                        </div>
                                        <div class=\"padded-item-content\">
                                            <div class=\"editable-field-wrapper\">
                                                <textarea class=\"editable-field achievement-item-description\"
                                                          placeholder=\"\"
                                                          style=\"overflow: hidden; word-wrap: break-word; height: 23px;\">{$item['description']['value']}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                        }
                    $html .= "            
                        </div>
                    </div>
                </div>";
        return $html;
    }

    public function getHtmlExperience($data) {

        $html = "<div id=\"ExperienceSection\" class=\"resume-section ExperienceSection \">
                    <div class=\"resume-section-container editable clickable\">
                    <div class=\"resume-section-text-container\">
                            <div class=\"editable-field-wrapper\">
                                <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                          placeholder=\"\"
                                          style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class=\"resume-section ExperienceSection \">";
                        foreach ($data['items'] as $item) {
                            $html .= "<div>
                                        <div class=\"resume-item-holder line-item editable clickable\" id=\"sections-0-items-0\">
                                            <div class=\"item-object experience-item\">
                                                <div class=\"inner\">
                                                    <div class=\"editable-field-wrapper\">
                                                        <textarea class=\"editable-field item-workplace resume-second-color\"
                                                                  placeholder=\"\"
                                                                  rows=\"1\"
                                                                  style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['company']['value']}</textarea>
                                                    </div>
                                                    <div class=\"with-icon-container top-xty\">
                                                        <a style=\"display: inline;\" href=\"\" role=\"button\" class=\"btn btn-sm btn-resume-data btn-link with-icon\">
                                                            <i class=\"icon icon-40-free-calendar\"></i>
                                                            <span>{$item['datePeriod']['monthFrom']}</span>&nbsp;
                                                            <span>{$item['datePeriod']['yearFrom']}</span>&nbsp;
                                                            <span>{$item['datePeriod']['monthTo']}</span>&nbsp;
                                                            <span>{$item['datePeriod']['yearTo']}</span>&nbsp;
                                                        </a>
                                                        <div  style=\"display: inline;\" class=\"with-icon  item-stretch\">
                                                            <i class=\"icon icon-05-pin-map\"></i>
                                                            <div style=\"display: inline-block;margin-bottom: -4px;\" class=\"editable-field-wrapper\">
                                                                <div class=\"editable-field-wrapper\">
                                                                    <textarea class=\"editable-field editable-field-xs\"
                                                                              rows=\"1\"
                                                                              style=\"overflow: hidden; word-wrap: break-word; height: 15px;\">{$item['location']['value']}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=\"editable-field-wrapper\">
                                                        <div class=\"editable-field-wrapper\">
                                                            <textarea class=\"editable-field item-description\"
                                                                      placeholder=\"\"
                                                                      rows=\"1\"
                                                                      style=\"overflow: hidden; word-wrap: break-word; height: 18px; margin-top: 35px;\">{$item['shortSummary']['value']}</textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class=\"top-xty\">";
                                                    foreach ($item['example']['data'] as $ex) {
                                                        $html .= "<div class=\"media top-xty no-bottom\">
                                                            <div class=\"media-left media-left-xs\">
                                                                <i class=\"icon icon-dot-1 bullet-dot\"></i>
                                                            </div>
                                                            <div class=\"media-body\">
                                                                <div class=\"editable-field-wrapper\">
                                                                    <textarea class=\"editable-field editable-field-muted editable-field-sm msd-elastic\"
                                                                            placeholder=\"\"
                                                                            style=\"overflow: hidden; word-wrap: break-word; height: 18px;\">$ex</textarea>
                                                                </div>
                                                            </div>
                                                        </div>";
                                                    }
                                                    $html .= "
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                        }
                    $html .= "    
                    </div>
                </div>";
        return $html;
    }

    public function getHtmlLanguages($data) {
        $width = 'width:' . ($data['position'] == 'left' ? '50%;display: inline-block;' : '100%;');
        $html = "    <div id=\"LanguageSection\" class=\"resume-section LanguageSection\">
                        <div class=\"resume-section-container clickable editable\">
                            <div class=\"resume-section-text-container\">
                                <div class=\"editable-field-wrapper\">
                                    <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                              placeholder=\"\"
                                              style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"resume-section\">";
                            foreach ($data['items'] as $item) {
                                $html .= "<div  style=\"{$width}\">
                                        <div class=\"resume-item-holder line-item editable clickable\" id=\"sections-2-items-0\" > 
                                            <div class=\"item-object language-item \">
                                                <div class=\"inner\">
                                                    <div class=\"language-item-content\">
                                                        <div class=\"editable-field-wrapper\">
                                                            <textarea class=\"editable-field language-item-name resume-first-color\"
                                                                      placeholder=\"\"
                                                                      rows=\"1\"
                                                                      style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['language']}</textarea>
                                                        </div>
                                                        <div class=\"language-item-level-text\">
                                                        {$item['proficiency']['value']}
                                                        </div>
                                                    </div>
                                                    <div class=\"language-item-slider lower-lines\">";
                                        $html .= $this->slideDot($item['level']['value']);
                                        $html .= "</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                    $html .= "        
                        </div>
                    </div>";
        return $html;
    }

    public function getHtmlPassion($data) {
        $width = 'width:' . ($data['position'] == 'left' ? '50%;display: inline-block;' : '100%;');

        $html = "<div id=\"PassionSection-1\" class=\"resume-section PassionSection\">
                    <div class=\"resume-section-container clickable editable\">
                        <div class=\"resume-section-text-container\">
                            <div class=\"editable-field-wrapper\">
                                <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                        placeholder=\"\"
                                        style=\"overflow: hidden; word-wrap: break-word;\">{$data['name']}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class=\"moveable-items\">";
                        foreach ($data['items'] as $item) {
                            $html .= "<div style=\"{$width}\" class=\"resume-item-holder line-item editable clickable\"
                             id=\"sections-7-items-0\">
                                    <div class=\"item-object passion-item\">
                                        <div class=\"inner\">
                                            <div class=\"passion-item-container editable\">
                                                <div class=\"passion-item-content\">
                                                    <div class=\"passion-item-icon\">
                                                        <div class=\"\"><i class=\"{$item['icon']['value']} resume-second-color\"></i></div>
                                                    </div>
                                                    <div class=\"editable-field-wrapper\">
                                                            <textarea class=\"editable-field passion-item-title resume-first-color \"
                                                                    placeholder=\"\"
                                                                    style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['name']}</textarea>
                                                    </div>
                                                </div>
                                                <div class=\"padded-item-content\">
                                                    <div class=\"editable-field-wrapper\">
                                                            <textarea placeholder=\"\" class=\"editable-field passion-item-description\"
                                                                    style=\"overflow: hidden; word-wrap: break-word; height: 22px;\">{$item['description']['value']}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                        }
                $html .= "        
                    </div>
                </div>";
                        $html += "<div class='page-break-before'></div>";
        return $html;
    }

    public function getHtmlProject($data) {
        $html = "<div id=\"ActivitySection\" class=\"resume-section ActivitySection\">
            <div class=\"resume-section-container clickable editable\">
                <div class=\"resume-section-text-container\">
                    <div class=\"editable-field-wrapper\">
                        <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                  placeholder=\"\"
                                  style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                    </div>
                </div>
            </div>
            <div class=\"resume-section\">
                <div>";
                foreach ($data['items'] as $item) {
                    $html .= "<div class=\"resume-item-holder line-item editable clickable\" id=\"sections-4-items-0\">
                        <div class=\"item-object activity-item\">
                            <div class=\"inner\">
                                <div class=\"editable-field-wrapper\">
                                    <textarea class=\"editable-field item-title resume-first-color resume-heading-font\"
                                              placeholder=\"\"
                                              style=\"overflow: hidden; word-wrap: break-word; height: 25px;\">{$item['title']}</textarea>
                                </div>
                                <div class=\"editable-field-wrapper\">
                                    <textarea class=\"editable-field item-description\"
                                        placeholder=\"\"
                                        rows=\"1\"
                                        style=\"overflow: hidden; word-wrap: break-word; height: 15px;\">{$item['link']['value']}</textarea>
                                </div>
                                <div class=\"with-icon-container top-xty\">
                                    <a style=\"display: inline;\" href=\"\" class=\"btn btn-sm btn-resume-data btn-link with-icon\">
                                        <i class=\"icon icon-40-free-calendar\"></i>
                                        <span>{$item['datePeriod']['monthFrom']}</span>&nbsp;
                                        <span>{$item['datePeriod']['yearFrom']}</span>&nbsp;
                                        <span>{$item['datePeriod']['monthTo']}</span>&nbsp;
                                        <span>{$item['datePeriod']['yearTo']}</span>&nbsp;
                                    </a>
                                    <div style=\"display: inline;\" class=\"with-icon item-stretch\">
                                        <i class=\"icon icon-05-pin-map\"></i>
                                        <div style=\"display: inline-block;margin-bottom: -4px;\" class=\"editable-field-wrapper\">
                                            <div class=\"editable-field-wrapper\">
                                                <textarea class=\"editable-field editable-field-xs\"
                                                          placeholder=\"\"
                                                          style=\"overflow: hidden; word-wrap: break-word; height: 15px;\">{$item['location']['value']}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"editable-field-wrapper\">
                                    <div class=\"editable-field-wrapper\">
                                        <textarea class=\"editable-field item-description\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 18px; margin-top: 35px;\">{$item['shortSummary']['value']}</textarea>
                                    </div>
                                </div>";
                                foreach ($item['example']['data'] as $key => $ex) {
                                    $html .= "<div class=\"top-xty\">
                                        <div class=\"media top-xty no-bottom\">
                                            <div class=\"media-left media-left-xs\"><i class=\"icon icon-dot-1 bullet-dot\"></i></div>
                                            <div class=\"media-body\">
                                                <div class=\"editable-field-wrapper\">
                                                    <textarea class=\"editable-field editable-field-muted editable-field-sm msd-elastic\"
                                                              placeholder=\"\"
                                                              style=\"overflow: hidden; word-wrap: break-word; height: 18px;\">{$ex}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                }
                    $html .= "
                            </div>
                        </div>
                    </div>";
                }
        $html .= "            
                </div>
            </div>
        </div>";
        return $html;
    }

    public function getHtmlSkill($data) {
        $width = 'width:' . ($data['position'] == 'left' ? '49%;display: inline-block;' : '100%;');
        $html = "<div id=\"SkillSection-0\" class=\"resume-section SkillSection\">
                    <div class=\"resume-section-container clickable editable\">
                        <div class=\"resume-section-text-container\">
                            <div class=\"editable-field-wrapper\">
                                <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                          placeholder=\"\"
                                          style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea></div>
                        </div>
                    </div><div class=\"moveable-items\">";

                    foreach ($data['items'] as $item) {
                        $html .= "<div style=\"{$width}\" class=\"resume-item-holder line-item editable clickable\"
                             id=\"sections-5-items-0\">
                            <div class=\"item-object skill-item skill-item-hazard\">
                                <div class=\"inner\">
                                    <div class=\"editable-field-wrapper\">
                                        <textarea class=\"editable-field skill-item-name resume-second-color\"
                                                  placeholder=\"\"
                                                  style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['name']}</textarea>
                                    </div>";
                        $html .= $this->sliderSkill($item);
                        $html .="            
                                </div>
                            </div>
                        </div>
                        ";
                    }
        $html .= "</div></div>";

        return $html;
    }

    public function getHtmlStrength($data) {
        $html = "<div id=\"TalentSection-0\" class=\"resume-section TalentSection\">
                <div class=\"resume-section-container clickable editable\">
                    <div class=\"resume-section-text-container\">
                        <div class=\"editable-field-wrapper\"><textarea
                                class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                placeholder=\"\"
                                style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                        </div>
                    </div>
                </div>
                <div class=\"moveable-items\">";
                    foreach ($data['items'] as $item) {
                        $html .= "<div class=\"resume-item-holder line-item editable clickable\"
                         id=\"sections-7-items-0\">
                            <div class=\"item-object talent-item\">
                                <div class=\"inner\">
                                    <div class=\"talent-item-content\">
                                        <div class=\"talent-item-icon editable\">
                                            <div class=\"\"><i class=\"{$item['icon']['value']}  resume-second-color\"></i></div>
                                        </div>
                                        <div class=\"editable-field-wrapper\"><textarea
                                                class=\"editable-field passion-item-title resume-first-color \"
                                                placeholder=\"\"
                                                style=\"overflow: hidden; word-wrap: break-word; height: 20px;\">{$item['name']}</textarea></div>
                                    </div>
                                    <div class=\"padded-item-content\">
                                        <div class=\"editable-field-wrapper\">
                                            <textarea class=\"editable-field passion-item-description\"
                                                    placeholder=\"\" rows=\"1\"
                                                    style=\"overflow: hidden; word-wrap: break-word; height: 22px;\">{$item['description']['value']}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
            $html .= "        
                </div>
            </div>";

        return $html;
    }

    public function getHtmlSummary($data) {
        $html = "<div id=\"SummarySection-0\" class=\"resume-section SummarySection\">
                        <div class=\"resume-section-container clickable editable\">
                            <div class=\"resume-section-text-container\">
                                <div class=\"editable-field-wrapper\">
                                    <textarea class=\"editable-field resume-first-border resume-section-text resume-heading-font resume-first-color\"
                                           style=\"overflow: hidden; word-wrap: break-word; height: 36px;\">{$data['name']}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=\"\">
                            <div class=\"resume-item-holder line-item clickable editable\" id=\"sections-6-items-0\">
                                <div class=\"item-object summary-item\">
                                    <div class=\"inner\">
                                        <div class=\"editable-field-wrapper\">
                                            <textarea class=\"editable-field\"
                                                    data-allow-new-line=\"true\"
                                                    style=\"overflow: hidden; word-wrap: break-word; height: 40px;\">{$data['value']}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
        return $html;
    }

    public function sliderSkill($data) {
        $left = '';
        if($this->dataCV['data']['skill']['position'] == 'left') {
            $tmp = $data['level']['value'] * 190/5;

        } else {
            $tmp = $data['level']['value'] * 300/5;
        }
        $left = "left: {$tmp}px !important;";
        $tmp += 5;
        $html = "<div class=\"slider-component slider-component-hazard ng-scope\" ng-if=\"item.level.display\">
            <div class=\"slider-container editable\">
                <div class=\"rzslider ng-isolate-scope\" rz-slider-model=\"item.level.value\"
                     rz-slider-options=\"\"><span class=\"rz-bar-wrapper\"><span class=\"rz-bar\"></span></span>
                    <span class=\"rz-bar-wrapper\" style=\"visibility: visible; width: {$tmp}px; left: 0px;\"><span
                            class=\"rz-bar rz-selection resume-second-background\" ng-style=\"barStyle\"></span></span> 
                            <span class=\"rz-pointer rz-pointer-min resume-second-background\" ng-style=\"minPointerStyle\" role=\"slider\" aria-valuenow=\"0\"
                            aria-valuetext=\"0\" aria-valuemin=\"0\" aria-valuemax=\"5\" tabindex=\"0\" style=\"{$left}\"></span>
                            <span
                            class=\"rz-pointer rz-pointer-max\" ng-style=\"maxPointerStyle\" style=\"display: none;\"></span> <span
                            class=\"rz-bubble rz-limit rz-floor\" style=\"visibility: hidden; left: 0px;\">0</span> <span
                            class=\"rz-bubble rz-limit rz-ceil\" style=\"visibility: visible; left: 300px;\">5</span> <span
                            class=\"rz-bubble\" style=\"visibility: visible; left: 9px;\">0</span> <span class=\"rz-bubble\"
                                                                                                     style=\"visibility: hidden;\"></span>
                    <span class=\"rz-bubble\" style=\"visibility: hidden;\"></span>
                    <ul ng-show=\"showTicks\" class=\"rz-ticks ng-hide\"></ul>
                </div>
            </div>
        </div>";
        return $html;
    }

    public function slideDot($data) {
        $html = "<div class=\"slider-component slider-component-dots ng-scope\">";
        for($i = 1; $i <= 5; $i++) {
            $html .= "<div class=\"dot-wrap \"><div class=\"slider-component-dot ";
            if($data >= $i) {
                $html .= "resume-second-background";
            } else {
                $html .= "resume-first-background";
            }
            $html .= "\" style=\"cursor:pointer\"></div>
                                                            </div>";
        }

        $html .= "</div>";
        return $html;
    }
}
