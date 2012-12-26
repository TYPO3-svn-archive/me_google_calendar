<?php
namespace TYPO3\MeGoogleCalendar\Domain\Model;

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
class Calendar extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * url
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $url;

	/**
	 * timezone
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $timezone;

	/**
	 * css
	 *
	 * @var \string
	 */
	protected $css;

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the url
	 *
	 * @return \string $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param \string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * Returns the timezone
	 *
	 * @return \string $timezone
	 */
	public function getTimezone() {
		return $this->timezone;
	}

	/**
	 * Sets the timezone
	 *
	 * @param \string $timezone
	 * @return void
	 */
	public function setTimezone($timezone) {
		$this->timezone = $timezone;
	}

	/**
	 * Returns the css
	 *
	 * @return \string $css
	 */
	public function getCss() {
		return $this->css;
	}

	/**
	 * Sets the css
	 *
	 * @param \string $css
	 * @return void
	 */
	public function setCss($css) {
		$this->css = $css;
	}

}
?>