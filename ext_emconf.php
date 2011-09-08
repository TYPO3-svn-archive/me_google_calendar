<?php

########################################################################
# Extension Manager/Repository config file for ext "me_google_calendar".
#
# Auto generated 08-09-2011 16:41
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Google Calendar',
	'description' => 'Includes the jQuery Plugin FullCalendar, which generates a skinable Calendar with different views (month, week, day, week list, day list) from Google Calendar XML Feed(s).',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.3.0',
	'dependencies' => 'cms',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Alexander Grein',
	'author_email' => 'ag@mediaessenz.eu',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'php' => '5.2.0-5.3.99',
			'typo3' => '4.1.0-4.5.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:90:{s:9:"ChangeLog";s:4:"f37e";s:10:"README.txt";s:4:"ee2d";s:64:"class.tx_megooglecalendar_tx_megooglecalendar_feeds_timezone.php";s:4:"23bd";s:12:"ext_icon.gif";s:4:"14fc";s:17:"ext_localconf.php";s:4:"06ce";s:14:"ext_tables.php";s:4:"7410";s:14:"ext_tables.sql";s:4:"f3e3";s:19:"flexform_ds_pi1.xml";s:4:"f1eb";s:34:"icon_tx_megooglecalendar_feeds.gif";s:4:"14fc";s:13:"locallang.xml";s:4:"72ea";s:16:"locallang_db.xml";s:4:"9fdb";s:17:"locallang_tca.xml";s:4:"fa5d";s:12:"t3jquery.txt";s:4:"5c4d";s:7:"tca.php";s:4:"b329";s:14:"doc/manual.sxw";s:4:"583d";s:19:"doc/wizard_form.dat";s:4:"5695";s:20:"doc/wizard_form.html";s:4:"0ed0";s:14:"pi1/ce_wiz.gif";s:4:"e339";s:37:"pi1/class.tx_megooglecalendar_pi1.php";s:4:"e94d";s:45:"pi1/class.tx_megooglecalendar_pi1_wizicon.php";s:4:"97b2";s:13:"pi1/clear.gif";s:4:"cc11";s:17:"pi1/locallang.xml";s:4:"0058";s:20:"res/fullcalendar.css";s:4:"73ba";s:19:"res/fullcalendar.js";s:4:"5e3f";s:23:"res/fullcalendar.min.js";s:4:"7290";s:11:"res/gcal.js";s:4:"c991";s:30:"res/jquery/jquery-1.6.2.min.js";s:4:"a1a8";s:41:"res/jquery/jquery-ui-1.8.16.custom.min.js";s:4:"65c7";s:26:"res/less/fullcalendar.less";s:4:"9aba";s:49:"res/themes/smoothness/jquery-ui-1.8.16.custom.css";s:4:"7814";s:59:"res/themes/smoothness/images/ui-bg_flat_0_aaaaaa_40x100.png";s:4:"2a44";s:60:"res/themes/smoothness/images/ui-bg_flat_75_ffffff_40x100.png";s:4:"8692";s:60:"res/themes/smoothness/images/ui-bg_glass_55_fbf9ee_1x400.png";s:4:"f8f4";s:60:"res/themes/smoothness/images/ui-bg_glass_65_ffffff_1x400.png";s:4:"e5a8";s:60:"res/themes/smoothness/images/ui-bg_glass_75_dadada_1x400.png";s:4:"c12c";s:60:"res/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png";s:4:"f425";s:60:"res/themes/smoothness/images/ui-bg_glass_95_fef1ec_1x400.png";s:4:"5a3b";s:69:"res/themes/smoothness/images/ui-bg_highlight-soft_75_cccccc_1x100.png";s:4:"72c5";s:56:"res/themes/smoothness/images/ui-icons_222222_256x240.png";s:4:"ebe6";s:56:"res/themes/smoothness/images/ui-icons_2e83ff_256x240.png";s:4:"2b99";s:56:"res/themes/smoothness/images/ui-icons_454545_256x240.png";s:4:"d3d6";s:56:"res/themes/smoothness/images/ui-icons_888888_256x240.png";s:4:"9c46";s:56:"res/themes/smoothness/images/ui-icons_cd0a0a_256x240.png";s:4:"3e45";s:51:"res/themes/south-street/jquery-ui-1.8.16.custom.css";s:4:"f529";s:62:"res/themes/south-street/images/ui-bg_glass_55_fcf0ba_1x400.png";s:4:"e8fa";s:70:"res/themes/south-street/images/ui-bg_gloss-wave_100_ece8da_500x100.png";s:4:"df1c";s:72:"res/themes/south-street/images/ui-bg_highlight-hard_100_f5f3e5_1x100.png";s:4:"c334";s:72:"res/themes/south-street/images/ui-bg_highlight-hard_100_fafaf4_1x100.png";s:4:"5fab";s:71:"res/themes/south-street/images/ui-bg_highlight-hard_15_459e00_1x100.png";s:4:"f561";s:71:"res/themes/south-street/images/ui-bg_highlight-hard_95_cccccc_1x100.png";s:4:"23c9";s:71:"res/themes/south-street/images/ui-bg_highlight-soft_25_67b021_1x100.png";s:4:"bdfc";s:71:"res/themes/south-street/images/ui-bg_highlight-soft_95_ffedad_1x100.png";s:4:"7103";s:67:"res/themes/south-street/images/ui-bg_inset-soft_15_2b2922_1x100.png";s:4:"c364";s:58:"res/themes/south-street/images/ui-icons_808080_256x240.png";s:4:"cd90";s:58:"res/themes/south-street/images/ui-icons_847e71_256x240.png";s:4:"6636";s:58:"res/themes/south-street/images/ui-icons_8dc262_256x240.png";s:4:"4128";s:58:"res/themes/south-street/images/ui-icons_cd0a0a_256x240.png";s:4:"3e45";s:58:"res/themes/south-street/images/ui-icons_eeeeee_256x240.png";s:4:"2e6d";s:58:"res/themes/south-street/images/ui-icons_ffffff_256x240.png";s:4:"342b";s:51:"res/themes/ui-lightness/jquery-ui-1.8.16.custom.css";s:4:"3ce8";s:47:"res/themes/ui-lightness/jquery.ui.accordion.css";s:4:"f3ef";s:41:"res/themes/ui-lightness/jquery.ui.all.css";s:4:"b70b";s:50:"res/themes/ui-lightness/jquery.ui.autocomplete.css";s:4:"c6f9";s:42:"res/themes/ui-lightness/jquery.ui.base.css";s:4:"acc3";s:44:"res/themes/ui-lightness/jquery.ui.button.css";s:4:"b412";s:42:"res/themes/ui-lightness/jquery.ui.core.css";s:4:"9ed9";s:48:"res/themes/ui-lightness/jquery.ui.datepicker.css";s:4:"528b";s:44:"res/themes/ui-lightness/jquery.ui.dialog.css";s:4:"6c6a";s:49:"res/themes/ui-lightness/jquery.ui.progressbar.css";s:4:"3d2d";s:47:"res/themes/ui-lightness/jquery.ui.resizable.css";s:4:"8c92";s:48:"res/themes/ui-lightness/jquery.ui.selectable.css";s:4:"0067";s:44:"res/themes/ui-lightness/jquery.ui.slider.css";s:4:"b241";s:42:"res/themes/ui-lightness/jquery.ui.tabs.css";s:4:"890b";s:43:"res/themes/ui-lightness/jquery.ui.theme.css";s:4:"918e";s:72:"res/themes/ui-lightness/images/ui-bg_diagonals-thick_18_b81900_40x40.png";s:4:"1c7f";s:72:"res/themes/ui-lightness/images/ui-bg_diagonals-thick_20_666666_40x40.png";s:4:"f040";s:62:"res/themes/ui-lightness/images/ui-bg_flat_10_000000_40x100.png";s:4:"c18c";s:63:"res/themes/ui-lightness/images/ui-bg_glass_100_f6f6f6_1x400.png";s:4:"5f18";s:63:"res/themes/ui-lightness/images/ui-bg_glass_100_fdf5ce_1x400.png";s:4:"d26e";s:62:"res/themes/ui-lightness/images/ui-bg_glass_65_ffffff_1x400.png";s:4:"e5a8";s:69:"res/themes/ui-lightness/images/ui-bg_gloss-wave_35_f6a828_500x100.png";s:4:"58d2";s:72:"res/themes/ui-lightness/images/ui-bg_highlight-soft_100_eeeeee_1x100.png";s:4:"384c";s:71:"res/themes/ui-lightness/images/ui-bg_highlight-soft_75_ffe45c_1x100.png";s:4:"b806";s:58:"res/themes/ui-lightness/images/ui-icons_222222_256x240.png";s:4:"ebe6";s:58:"res/themes/ui-lightness/images/ui-icons_228ef1_256x240.png";s:4:"ff17";s:58:"res/themes/ui-lightness/images/ui-icons_ef8c08_256x240.png";s:4:"ef9a";s:58:"res/themes/ui-lightness/images/ui-icons_ffd27a_256x240.png";s:4:"39c5";s:58:"res/themes/ui-lightness/images/ui-icons_ffffff_256x240.png";s:4:"342b";s:36:"static/google_calendar/constants.txt";s:4:"b60d";s:32:"static/google_calendar/setup.txt";s:4:"e318";}',
	'suggests' => array(
	),
);

?>