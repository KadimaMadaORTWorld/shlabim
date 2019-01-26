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
 * A two column layout for the boost theme.
 *
 * @package   theme_boost
 * @copyright 2016 Damyon Wiese
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $USER, $PAGE;

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}


$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
// $regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();

$languages = devlion_get_languages();
$main_slider = devlion_get_main_slider();
$custom_menu = devlion_render_custom_menu();
$courseblocks = theme_devlion_courses_list();

//$label_blocks = devlion_render_labels_main_course(); // temp sliders
// $header_settings = $OUTPUT->context_header_settings_menu();

$arr_tmp = explode('?' , $_SERVER['REQUEST_URI']);
$arr_tmp = array_filter(explode('/' , $arr_tmp[0]), 'strlen');
$arr_tmp = array_values($arr_tmp);

$is_student = 0;
if($arr_tmp[0] == 'course' && $arr_tmp[1] == 'index.php'){

    //Check if user student  role = 5
    if(user_has_role_assignment($USER->id,5)) $is_student = 1;
}

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,

    'sesskey' => $USER->sesskey,
    'is_admin' => is_siteadmin(),
    'version_css' => time(),
    'languages' => $languages,
    'mainslider' => $main_slider,
    'courseblocks_enable' => (!empty($courseblocks))?true:false,
    'courseblocks' => $courseblocks,
    'custommenu' => $custom_menu,
    'header_settings' => $header_settings,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'navdraweropen' => $navdraweropen,
    'is_student' => $is_student,

    //'labelblocks' => $label_blocks,
    //'regionmainsettingsmenu' => $regionmainsettingsmenu,
    //'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu)
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_devlion/columns2', $templatecontext);
