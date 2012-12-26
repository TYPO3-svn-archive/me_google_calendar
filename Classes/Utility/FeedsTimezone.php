<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Alexander Grein <mail@mediaessenz.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * Class/Function which manipulates the item-array for table/field tx_megooglecalendar_feeds_timezone.
 *
 * @author	Alexander Grein <mail@mediaessenz.de>
 * @package	TYPO3
 * @subpackage	tx_megooglecalendar
 */
class Tx_MeGoogleCalendar_Utility_FeedsTimezone {

	/**
	 * Generates the timezone menu
	 *
	 * @param	array $params
	 * @param	object $pObj
	 * @return	void
	 */
	function main(&$params,&$pObj)	{

		$timezones = DateTimeZone::listAbbreviations();

		$cities = array();
		foreach($timezones as $key => $zones) {
		    foreach($zones as $id => $zone ) {
		        /**
		         * Only get timezones explicitly not part of "Others".
		         * @see http://www.php.net/manual/en/timezones.others.php
		         */
		        if (preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'])) {
		            $cities[$zone['timezone_id']][] = $key;
		        }
		    }
		}
		
		// For each city, have a comma separated list of all possible timezones for that city.
		foreach($cities as $key => $value) {
		    $cities[$key] = join(', ', $value);
		}

		// Only keep one city (the first and also most important) for each set of possibilities. 
		$cities = array_unique($cities);
		
		// Sort by area/city name.
		ksort($cities, SORT_LOCALE_STRING);
		// Adding an item!
		foreach ($cities as $key => $value) {
			$params['items'][] = array($pObj->sL($key), $key);
		}
		// No return - the $params and $pObj variables are passed by reference, so just change content in then and it is passed back automatically...
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/me_google_calendar/class.tx_megooglecalendar_feeds_timezone.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/me_google_calendar/class.tx_megooglecalendar_feeds_timezone.php']);
}

?>