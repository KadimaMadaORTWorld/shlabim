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
* devlion settings.
*
* @package   theme_devlion
* @copyright Copyright (c) 2015 Moodlerooms Inc. (http://www.moodlerooms.com)
* @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

defined('MOODLE_INTERNAL') || die;


$ADMIN->add('themes', new admin_category('theme_devlion', 'devlion'));
$settings = null; // Unsets the default $settings object initialised by Moodle.


if ($ADMIN->fulltree) {

}


//### NEW Features------------------------------------------------

// Slide Show settings
$slideshow = new admin_settingpage('themedevlionslideshow', get_string('slideshow', 'theme_devlion'));

//------------------------------------------SLIDESHOW-------------------------------------------------------  
// Auto Scroll.
$name = 'theme_devlion/autoslideshow';
$title = get_string('autoslideshow', 'theme_devlion');
$description = get_string('autoslideshowdesc', 'theme_devlion');
$yes = get_string('yes');
$no = get_string('no');
$default = 1;
$choices = array(1 => $yes , 0 => $no);
$setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
$setting->set_updatedcallback('theme_reset_all_caches');
$slideshow->add($setting);

// Slide Show Interval.
$name = 'theme_devlion/slideinterval';
$title = get_string('slideinterval', 'theme_devlion');
$description = get_string('slideintervaldesc', 'theme_devlion');
$default = 3000;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
$setting->set_updatedcallback('theme_reset_all_caches');
$slideshow->add($setting);

// Slide description setting.
//$name = 'theme_devlion/description';
//$title = new lang_string('description', 'theme_devlion');
//$description = new lang_string('description_desc', 'theme_devlion');
//$setting = new admin_setting_confightmleditor($name, $title, $description, '');
//$slideshow->add($setting);

// Number of slides.
$name = 'theme_devlion/numberofslides';
$title = get_string('numberofslides', 'theme_devlion');
$description = get_string('numberofslidesdesc', 'theme_devlion');
$default = 3;
$choices = array(
    1 => '1',
    2 => '2',
    3 => '3',
    4 => '4',
    5 => '5',
    6 => '6',
    7 => '7',
    8 => '8',
    9 => '9',
    10 => '10',
    11 => '11',
    12 => '12',
);
$slideshow->add(new admin_setting_configselect($name, $title, $description, $default, $choices));

$numberofslides = get_config('theme_devlion', 'numberofslides');
for ($i = 1; $i <= $numberofslides; $i++) {
    // This is the descriptor for Slide One.
    $name = 'theme_devlion/slide' . $i . 'info';
    $heading = get_string('slideno', 'theme_devlion', array('slide' => $i));
    $information = get_string('slidenodesc', 'theme_devlion', array('slide' => $i));
    $setting = new admin_setting_heading($name, $heading, $information);
    $slideshow->add($setting);

    // Slide Image.
    $name = 'theme_devlion/slide' . $i . 'image';
    $title = get_string('slideimage', 'theme_devlion');
    $description = get_string('slideimagedesc', 'theme_devlion');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slideshow->add($setting);

    // Slide Caption.
    $name = 'theme_devlion/slide' . $i . 'caption';
    $title = get_string('slidecaption', 'theme_devlion');
    $description = get_string('slidecaptiondesc', 'theme_devlion');
    $default = 'lang:slidecaptiondefault';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slideshow->add($setting);

    // Slide Link text.
    //     $name = 'theme_devlion/slide' . $i . 'urltext';
    //        $title = get_string('slideurltext', 'theme_devlion');
    //        $description = get_string('slideurltextdesc', 'theme_devlion');
    //        $default = 'lang:knowmore';
    //        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    //        $setting->set_updatedcallback('theme_reset_all_caches');
    //        $slideshow->add($setting);

    // Slide Url.
    $name = 'theme_devlion/slide' . $i . 'url';
    $title = get_string('slideurl', 'theme_devlion');
    $description = get_string('slideurldesc', 'theme_devlion');
    $default = 'http://www.example.com/';
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slideshow->add($setting);

    // Slide Description Text.
    $name = 'theme_devlion/slide' . $i . 'desc';
    $title = get_string('slidedesc', 'theme_devlion');
    $description = get_string('slidedesctext', 'theme_devlion');
    $default = 'lang:slidedescdefault';
    $setting = new admin_setting_confightmleditor($name, $title, $description, '');    
    $setting->set_updatedcallback('theme_reset_all_caches');
    $slideshow->add($setting);

}

$ADMIN->add('theme_devlion', $slideshow);




