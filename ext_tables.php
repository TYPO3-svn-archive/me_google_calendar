<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';


t3lib_extMgm::addPlugin(array(
    'LLL:EXT:me_google_calendar/locallang_db.xml:tt_content.list_type_pi1',
    $_EXTKEY . '_pi1',
    t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


if (TYPO3_MODE == 'BE') {
    $TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_megooglecalendar_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_megooglecalendar_pi1_wizicon.php';
}

t3lib_extMgm::addStaticFile($_EXTKEY,'static/google_calendar/', 'google calendar');


t3lib_extMgm::allowTableOnStandardPages('tx_megooglecalendar_feeds');


if (TYPO3_MODE == 'BE')    {
    include_once(t3lib_extMgm::extPath('me_google_calendar').'class.tx_megooglecalendar_feeds_timezone.php');
}

$TCA['tx_megooglecalendar_feeds'] = array (
    'ctrl' => array (
        'title'     => 'LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds',      
        'label'     => 'title',    
        'tstamp'    => 'tstamp',
        'crdate'    => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY title',    
        'delete' => 'deleted',    
        'enablecolumns' => array (        
            'disabled' => 'hidden',
        ),
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
        'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_megooglecalendar_feeds.gif',
    ),
);

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform_ds_pi1.xml');
?>