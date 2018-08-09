<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle's devlion theme, an example of how to make a Bootstrap theme
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_devlion
 * @copyright 2013 Moodle, moodle.org
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Parses CSS before it is cached.
 *
 * This function can make alterations and replace patterns within the CSS.
 *
 * @param string $css The CSS
 * @param theme_config $theme The theme config object.
 * @return string The parsed CSS The parsed CSS.
 */
function theme_devlion_process_css($css, $theme) {
    global $OUTPUT;

    // Set the background image for the logo.
    $logo = $OUTPUT->get_logo_url(null, 75);
    $css = theme_devlion_set_logo($css, $logo);

    // Set custom CSS.
    if (!empty($theme->settings->customcss)) {
        $customcss = $theme->settings->customcss;
    } else {
        $customcss = null;
    }
    $css = theme_devlion_set_customcss($css, $customcss);

    return $css;
}

function theme_devlion_get_setting($setting, $format = false) {
    global $CFG;
    require_once($CFG->dirroot . '/lib/weblib.php');
    static $theme;
    if (empty($theme)) {
        $theme = theme_config::load('devlion');
    }
    if (empty($theme->settings->$setting)) {
        return false;
    } else if (!$format) {
        return $theme->settings->$setting;
    } else if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    } else if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    } else {
        return format_string($theme->settings->$setting);
    }
}

/**
 * Adds the logo to CSS.
 *
 * @param string $css The CSS.
 * @param string $logo The URL of the logo.
 * @return string The parsed CSS
 */
function theme_devlion_set_logo($css, $logo) {
    $tag = '[[setting:logo]]';
    $replacement = $logo;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
//function theme_devlion_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
//    if ($context->contextlevel == CONTEXT_SYSTEM and ($filearea === 'logo' || $filearea === 'smalllogo')) {
//        $theme = theme_config::load('devlion');
//        // By default, theme files must be cache-able by both browsers and proxies.
//        if (!array_key_exists('cacheability', $options)) {
//            $options['cacheability'] = 'public';
//        }
//        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
//    } else {
//        send_file_not_found();
//    }
//}

/**
* Serves any files associated with the theme settings.
*
* @param stdClass $course
* @param stdClass $cm
* @param context $context
* @param string $filearea
* @param array $args
* @param bool $forcedownload
* @param array $options
* @return bool
*/
function theme_devlion_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    static $theme;

    if (empty($theme)) {
        $theme = theme_config::load('devlion');
    }
    if ($context->contextlevel == CONTEXT_SYSTEM && in_array($filearea, ['logo', 'favicon', 'fs_one_image', 'fs_two_image', 'fs_three_image', 'fs_four_image'])) {
        $theme = theme_config::load('devlion');
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }else if (($context->contextlevel == CONTEXT_SYSTEM || $context->contextlevel == CONTEXT_COURSE)
        && $filearea == 'coverimage' || $filearea == 'coursecard') {
        theme_devlion_send_file($context, $filearea, $args, $forcedownload, $options);
    } else {
        if (preg_match("/slide[1-9][0-9]*image/", $filearea) !== false) {
            return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
        }else{
            send_file_not_found();
        }
    }
}

/**
 * Adds any custom CSS to the CSS before it is cached.
 *
 * @param string $css The original CSS.
 * @param string $customcss The custom CSS to add.
 * @return string The CSS which now contains our custom CSS.
 */
function theme_devlion_set_customcss($css, $customcss) {
    $tag = '[[setting:customcss]]';
    $replacement = $customcss;
    if (is_null($replacement)) {
        $replacement = '';
    }

    $css = str_replace($tag, $replacement, $css);

    return $css;
}

/**
 * Returns an object containing HTML for the areas affected by settings.
 *
 * Do not add devlion specific logic in here, child themes should be able to
 * rely on that function just by declaring settings with similar names.
 *
 * @param renderer_base $output Pass in $OUTPUT.
 * @param moodle_page $page Pass in $PAGE.
 * @return stdClass An object with the following properties:
 *      - navbarclass A CSS class to use on the navbar. By default ''.
 *      - heading HTML to use for the heading. A logo if one is selected or the default heading.
 *      - footnote HTML to use as a footnote. By default ''.
 */
function theme_devlion_get_html_for_settings(renderer_base $output, moodle_page $page) {
    global $CFG;
    $return = new stdClass;

    $return->navbarclass = '';
    if (!empty($page->theme->settings->invert)) {
        $return->navbarclass .= ' navbar-inverse';
    }

    // Only display the logo on the front page and login page, if one is defined.
    if (!empty($page->theme->settings->logo) &&
            ($page->pagelayout == 'frontpage' || $page->pagelayout == 'login')) {
        $return->heading = html_writer::tag('div', '', array('class' => 'logo'));
    } else {
        $return->heading = $output->page_heading();
    }

    $return->footnote = '';
    if (!empty($page->theme->settings->footnote)) {
        $return->footnote = '<div class="footnote text-center">'.format_text($page->theme->settings->footnote).'</div>';
    }

    return $return;
}

/**
 * All theme functions should start with theme_devlion_
 * @deprecated since 2.5.1
 */
function devlion_process_css() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_devlion_
 * @deprecated since 2.5.1
 */
function devlion_set_logo() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * All theme functions should start with theme_devlion_
 * @deprecated since 2.5.1
 */
function devlion_set_customcss() {
    throw new coding_exception('Please call theme_'.__FUNCTION__.' instead of '.__FUNCTION__);
}

/**
 * Get array of languages
 */
function devlion_get_languages() {
    global $CFG, $PAGE;

    $default_langs = array('en','he','ar');

    $langs = get_string_manager()->get_list_of_translations();
    $result = array();
    $current_lang = current_language();

    foreach($langs as $lang => $strLangName){
        if(in_array($lang, $default_langs)){
            $tmp = array();
            $url = new moodle_url($_SERVER['PHP_SELF'] , array_merge($PAGE->url->params(), array('lang' => $lang)));

            $arr = explode(' ', $strLangName);
            if(!in_array($lang, array('he','ar')) ){
                //$tmp['langname'] = strtolower($arr[0]);
                $tmp['langname'] = $arr[0];
            }else{
                $tmp['langname'] = $arr[0];
            }

            $tmp['url'] = $url;

            if($current_lang == $lang){
                $tmp['activeclass'] = 'class = "header__lang--active"';
            }else{
                $tmp['activeclass'] = '';
            }


            $result[] = $tmp;
        }
    }

    return $result;
}

function theme_devlion_return_string_by_lang($str) {
    global $CFG, $PAGE;

    $current_lang = current_language();
    $arr_str = explode('-', $str);

    if(count($arr_str) > 1){
        $arr_result = array();

        //remove first item from array
        unset($arr_str[0]);

        foreach($arr_str as $item){
            $arr_item = explode('|', $item);

            if(count($arr_item) >= 2){
                $arr_result[trim($arr_item[0])] = trim($arr_item[1]);
            }
        }

        return $arr_result[$current_lang];
    }else{
        return $str;
    }
}

function theme_devlion_return_carusela_by_lang($str) {
    global $CFG, $PAGE;

    $current_lang = current_language();
    $arr_str = explode('-', $str);

    if(count($arr_str) > 1){
        $arr_result = array();

        //remove first item from array
        unset($arr_str[0]);

        foreach($arr_str as $item){
            $arr_item = explode('|', $item);

            if(count($arr_item) >= 2){
                $str_display = trim($arr_item[1]);

                $str_display = '<p>'.$str_display.'</p>';
                $str_display = str_replace('<p></p>', '', $str_display);

                $arr_result[trim($arr_item[0])] = $str_display;
            }
        }

        return $arr_result[$current_lang];
    }else{
        return $str;
    }
}

function theme_devlion_render_slideimg($sliname) {
    global $PAGE, $OUTPUT;

    if (theme_devlion_get_setting($sliname)) {
        $slideimage = $PAGE->theme->setting_file_url($sliname, $sliname);
        return $slideimage;
    }
    return '/theme/devlion/img/default-slide.jpg';
}

function devlion_get_main_slider() {
    global $PAGE, $OUTPUT;

    $result = array();
    $nos = theme_devlion_get_setting('numberofslides');

    if(empty(theme_devlion_get_setting('autoslideshow'))){
        $result['autoslideshow'] = 0;
    }else{
        $result['autoslideshow'] = theme_devlion_get_setting('autoslideshow');
    }

    $result['slideinterval'] = theme_devlion_get_setting('slideinterval');
    $result['description'] = theme_devlion_return_string_by_lang(theme_devlion_get_setting('description'));

    if(!empty($nos) && $nos>0){
        for($i=1;$i<=$nos;$i++){
            $tmp = array();
            $tmp['url'] = theme_devlion_render_slideimg('slide'.$i.'image');
            $tmp['description'] = theme_devlion_return_carusela_by_lang(theme_devlion_get_setting('slide'.$i.'desc'));

            $result['images'][] = $tmp;
        }
    }

    return $result;
}

function devlion_icontent_parse_image($id_label, $text)
{
    global $DB;
    $sql = "
       SELECT c.id as id
       FROM {course_modules} AS cm
       INNER JOIN {context} c ON (c.instanceid = cm.id AND c.contextlevel=70)
       WHERE cm.module=12 AND cm.instance=?
    ";
    $result = $DB->get_record_sql($sql, array($id_label));

    $text = str_replace('@@PLUGINFILE@@', "/pluginfile.php/".$result->id."/mod_label/intro", $text);
    return $text;
}

function devlion_parser_label($str, $id_label) {
    global $PAGE, $OUTPUT, $DB;

    $result = array();

    $str = str_replace('<p>', '[[tmp]]', $str);
    $str = str_replace('</p>', '[[tmp]]', $str);
    $str = str_replace('<br>', '[[tmp]]', $str);
    $str = str_replace('</br>', '[[tmp]]', $str);
    $str = str_replace('<div>', '[[tmp]]', $str);
    $str = str_replace('</div>', '[[tmp]]', $str);
    $str = devlion_icontent_parse_image($id_label, $str);

    $result = explode('[[tmp]]', $str);

    foreach ($result as $i=>$row) {
        if ($row=="" || strlen($row)==2)
           unset($result[$i]);
    }
    $result = array_values($result);

    return $result;
}

function devlion_get_labels_main_course() {
    global $PAGE, $OUTPUT, $DB;

    $result = array();

    $labels = $DB->get_records('label', array('course' => 1));

    //echo "<pre>"; print_r($labels); exit;

    if(!empty($labels)){
        foreach($labels as $label){
            if(!empty($label->intro)){
                $tmp = devlion_parser_label($label->intro, $label->id);
                $result[] = $tmp;
            }
        }
    }

    return $result;
}

function devlion_render_labels_main_course($num_block) {
    global $PAGE, $OUTPUT, $DB;
    $html_item1 = '';
    $html_item2 = '';
    $html_item3 = '';

    $labels = devlion_get_labels_main_course();

    //echo "<pre>"; print_r($labels); exit;

    if(!empty($labels)){
        foreach($labels as $item){

            switch ($item[0]) {
                case 'type1':
                    $html_item1 = devlion_render_type_1($item);
                    break;
                case 'type2':
                    $html_item2 = devlion_render_type_2($item);
                    break;
                case 'type3':
                    $html_item3 = devlion_render_type_3($item);
                    break;
            }
        }
    }

    if(in_array($num_block, array(1,2,3))){
        switch ($num_block) {
            case 1:
                return $html_item1;
                break;
            case 2:
                return $html_item2;
                break;
            case 3:
                return $html_item3;
                break;
        }
    }else return '';

    return $html_item1.$html_item2.$html_item3;
}

function devlion_render_type_1($item) {

    $arr_new = array();
    $level = 0;
    for($i=1;$i<count($item);$i++){
        if($item[$i] == 'delimiter'){$level++;continue;}
        $arr_new[$level][] = $item[$i];
    }

    $html = '
        <div class = "unit__wrapper" id="slider2">
          <h3 class = "unit__title"><span>'.get_string('learning_materials_database', 'theme_devlion').'</span></h3>
    ';

    foreach($arr_new as  $key => $item){

        $html .= '
              <div class = "unit unit--materials-middle">
                <div class = "unit__wrap">
                  <div class = "unit__slider">
                    <span class = "unit__note">'.theme_devlion_return_string_by_lang($item[0]).'</span>
                    <ul id = "unit__slider--materials-middle'.$key.'" class = "unit__slider--materials-middle">
        ';

        for($i=1;$i<count($item);$i=$i+2){
            $html .= '
                <li class = "unit__slider-item">
                    <p  class = "unit__slider-title">'.theme_devlion_return_string_by_lang($item[$i]).'</p>
                    <p class = "unit__slider-image">
                        '.$item[$i+1].'
                    </p>
                </li>
            ';
        }

        $html .= '
                </ul>
              </div>
              <div id = "unitSliderMaterialsNext'.$key.'" class = "unit__arrow-next"></div>
              <div id = "unitSliderMaterialsPrev'.$key.'" class = "unit__arrow-prev"></div>
            </div>
          </div>
        ';
    }

    $html .= '
        </div>
    ';

    return $html;
}

function devlion_render_type_2($item) {
    $html = '
        <div class = "unit unit--options" id="slider3">
          <div class = "unit__wrap">
            <h3 class = "unit__title"><span>'.get_string('digital_content_environments', 'theme_devlion').'</span></h3>
            <div class = "unit__slider">
              <ul class = "unit__slider--options">
    ';

    for($i=1;$i<count($item);$i=$i+2){

        //Get url //preg_match_all('`"([^"]*)"`', $item[$i+1], $results); //$results[0][0]

        $html .= '
            <li class = "unit__slider-item">
                <p class = "unit__slider-image">
                    '.$item[$i+1].'
                </p>
                <p class = "unit__slider-title unit__slider-title--orange">'.theme_devlion_return_string_by_lang($item[$i]).'</p>
            </li>
        ';
    }

    $html .= '
              </ul>
            </div>
            <div id = "unitSliderOptionsNext" class = "unit__arrow-next"></div>
            <div id = "unitSliderOptionsPrev" class = "unit__arrow-prev"></div>
          </div>
        </div>
    ';

    return $html;
}

function devlion_render_type_3($item) {
    $html = '
        <div class = "unit unit--additions" id="slider4">
          <div class = "unit__wrap">
            <h3 class = "unit__title"><span>'.get_string('leisure_and_recreation', 'theme_devlion').'</span></h3>
            <div class = "unit__slider">
              <ul class = "unit__slider--additions">
    ';

    for($i=1;$i<count($item);$i=$i+2){
        $html .= '
            <li class = "unit__slider-item">
                <p  class = "unit__slider-title">'.theme_devlion_return_string_by_lang($item[$i]).'</p>
                <p class = "unit__slider-image">
                  '.$item[$i+1].'
                </p>
            </li>
        ';
    }

    $html .= '
              </ul>
              <div id = "unitSliderAdditionsNext" class = "unit__arrow-next"></div>
              <div id = "unitSliderAdditionsPrev" class = "unit__arrow-prev"></div>
            </div>
          </div>
        </div>
    ';

    return $html;
}

function devlion_render_custom_menu() {
    global $CFG, $USER;

    $menu = new custom_menu($CFG->custommenuitems, current_language());
    $courses = enrol_get_all_users_courses($USER->id, true, null, 'fullname ASC');

    $content = '<nav class = "header__menu-wrap"><ul class = " header__menu">';

    foreach ($menu->get_children() as $label) {

        //if(devlion_if_custom_menu_contain_data($label)){
        if(1){

            $label_url = '';
            if(!empty($label->get_url())) {$label_url = 'href = "'.$label->get_url().'"';}
              $content .= '<li class = "header__menu-item" tabindex = "0"><a '.$label_url.'><span >'.$label->get_title().'</span></a>';

            if ($label->has_children()){

                $content .= '<ul class = "header__sub-menu">';

                  foreach ($label->get_children() as $item) {
                      if($item->get_title() == "[[mycourses]]"){
                          if(!empty($courses)){
                          foreach ($courses as $item) {
                            if ($item->visible){
                              $content .= '<li class = "header__sub-menu-item"><a href="/course/view.php?id='.$item->id.'">'.$item->fullname.'</a></il>';
                            }
                              // $content .= '<li class = "header__sub-menu-item"><a href="/course/view.php?id='.$item->id.'">'.$item->fullname.'</a></il>';
                          }
                          }
                      }else{
                          if($item->get_title() != ''){

                              $content .= '<li class = "header__sub-menu-item"><a href = "'.$item->get_url().'">'.$item->get_title().'</a></il>';
                          }
                      }
                  }

                $content .= '</ul>';
            }

            $content .= '</li>';
        }
    }


    $content .= '</ul></nav>';

    return $content;
}

function devlion_if_custom_menu_contain_data($label) {
    global $CFG, $USER;

    $courses = enrol_get_all_users_courses($USER->id, true, null, 'visible DESC, sortorder DESC');
    $content = '';

    //if ($label->has_children()){

        foreach ($label->get_children() as $item) {
            if($item->get_title() == "[[mycourses]]"){
                if(!empty($courses)){
                foreach ($courses as $item) {
                    $content .= '<li class = "header__sub-menu-item"><a href="/course/view.php?id='.$item->id.'">'.$item->fullname.'</a></il>';
                }
                }
            }else{
//                if($item->get_title() != ''){
//                    $content .= '<li class = "header__sub-menu-item"><a href = "'.$item->get_url().'">'.$item->get_title().'</a></il>';
//                }
                $content .= '<li class = "header__sub-menu-item"><a href = "'.$item->get_url().'">'.$item->get_title().'</a></il>';
            }
        }

        if(!empty($content)) return true;

    //}

    return false;
}

function theme_devlion_courses_list() {
    global $OUTPUT, $DB, $USER;

    $courses = enrol_get_all_users_courses($USER->id, true, null, 'visible DESC, sortorder ASC');
    $arrCourses = array();
    foreach ($courses as $course) {
        $currcourse = $DB->get_record('course', array("id"=>$course->id));

        if (!$currcourse->visible){
            continue;
        }
        $currcoursecon = context_course::instance($currcourse->id);

        $tmp = new stdClass();
        $tmp->title = format_string($currcourse->fullname);
        $tmp->id = $currcourse->id;
        $tmp->category = $currcourse->category;

//        if($image = $DB->get_record_sql("SELECT * FROM {files} WHERE contextid = ? AND component LIKE 'course' AND filearea LIKE 'overviewfiles' AND itemid = ? AND filename NOT LIKE '.'", array($currcoursecon->id, 0))) {
//
//            $fs = get_file_storage();
//            $file = $fs->get_file($currcoursecon->id, 'course', 'overviewfiles', 0, '/', $image->filename);
//
//            $tmp->img = moodle_url::make_pluginfile_url(
//                $file->get_contextid(),
//                $file->get_component(),
//                $file->get_filearea(),
//                '',
//                $file->get_filepath(),
//                $file->get_filename()
//            );
//        }

        $arrCourses[] = $tmp;

    }

    return $arrCourses;
}
