<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_megooglecalendar_domain_model_calendar'] = array(
	'ctrl' => $TCA['tx_megooglecalendar_domain_model_calendar']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, url, timezone, css',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, url, timezone, css,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_megooglecalendar_domain_model_calendar',
				'foreign_table_where' => 'AND tx_megooglecalendar_domain_model_calendar.pid=###CURRENT_PID### AND tx_megooglecalendar_domain_model_calendar.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_google_calendar/Resources/Private/Language/locallang_db.xlf:tx_megooglecalendar_domain_model_calendar.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'url' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_google_calendar/Resources/Private/Language/locallang_db.xlf:tx_megooglecalendar_domain_model_calendar.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'timezone' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_google_calendar/Resources/Private/Language/locallang_db.xlf:tx_megooglecalendar_domain_model_calendar.timezone',
			'config' => array(
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:me_google_calendar/Resources/Private/Language/locallang_db.xlf:tx_megooglecalendar_domain_model_calendar.timezone.I.0', '0'),
				),
				'itemsProcFunc' => 'Tx_MeGoogleCalendar_Utility_FeedsTimezone->main',
				'size' => 1,
				'maxitems' => 1,
				'default' => date_default_timezone_get(),
				'eval' => 'trim,required'
			),
		),
		'css' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:me_google_calendar/Resources/Private/Language/locallang_db.xlf:tx_megooglecalendar_domain_model_calendar.css',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);

?>