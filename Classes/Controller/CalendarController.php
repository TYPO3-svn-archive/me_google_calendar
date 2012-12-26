<?php
namespace TYPO3\MeGoogleCalendar\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Alexander Grein <mail@typo3-webagentur.com>, MEDIA::ESSENZ
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package me_google_calendar
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CalendarController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * calendarRepository
	 *
	 * @var \TYPO3\MeGoogleCalendar\Domain\Repository\CalendarRepository
	 * @inject
	 */
	protected $calendarRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 */
	protected $configurationManager;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$calendars = $this->calendarRepository->findAll();
		$this->view->assign('calendars', $calendars);
		$cObj = $this->configurationManager->getContentObject();
		$this->view->assign('contentKey', 'me_google_calendar_c' . $cObj->data['uid']);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK));
	}

	/**
	 * Injects the Configuration Manager and is initializing the framework settings
	 *
	 * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager Instance of the Configuration Manager
	 * @return void
	 */
	public function injectConfigurationManager(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager) {
		$this->configurationManager = $configurationManager;

		//$tsSetup = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK, 'MeGoogleCalendar', 'Pi1');
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($tsSetup['settings']);

		$mergedSettings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS);
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($mergedSettings);

		$fullTyposcriptSettings = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
		$tsSetupSettings = $fullTyposcriptSettings['plugin.']['tx_megooglecalendar.']['settings.'];
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($tsSetupSettings);

		// start override
		if (isset($tsSetupSettings['overrideFlexformSettingsIfEmpty'])) {
			$overrideIfEmpty = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $tsSetupSettings['overrideFlexformSettingsIfEmpty'], TRUE);
			foreach ($overrideIfEmpty as $key) {
				// if flexform setting is empty and value is available in TS
				if ((!isset($mergedSettings[$key]) || empty($mergedSettings[$key]))
					&& isset($tsSetupSettings[$key])) {
					$mergedSettings[$key] = $tsSetupSettings[$key];
				}
			}
		}

		$this->settings = $mergedSettings;
	}
}
?>