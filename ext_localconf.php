<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Pi1',
	array(
		'Calendar' => 'list',
		
	),
	// non-cacheable actions
	array(
		'Calendar' => 'list',
		
	)
);
t3lib_extMgm::addUserTSConfig('
    options.saveDocNew.tx_megooglecalendar_feeds=1
');

?>