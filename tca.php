<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_megooglecalendar_feeds'] = array (
	'ctrl' => $TCA['tx_megooglecalendar_feeds']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title,url,timezone,css'
	),
	'feInterface' => $TCA['tx_megooglecalendar_feeds']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'timezone' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds.timezone',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds.timezone.I.0', '0'),
				),
				'itemsProcFunc' => 'tx_megooglecalendar_feeds_timezone->main',
				'size' => 1,	
				'maxitems' => 1,
				'default' => date_default_timezone_get(),
			)
		),
		'css' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:me_google_calendar/locallang_db.xml:tx_megooglecalendar_feeds.css',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2, url;;;;3-3-3, timezone, css')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>