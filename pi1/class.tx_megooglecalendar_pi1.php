<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Alexander Grein <ag@mediaessenz.eu>
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

require_once(PATH_tslib.'class.tslib_pibase.php');

if (t3lib_extMgm::isLoaded('t3jquery')) {
    require_once(t3lib_extMgm::extPath('t3jquery').'class.tx_t3jquery.php');
}

/**
 * Plugin 'show google calendar' for the 'me_google_calendar' extension.
 *
 * @author	Alexander Grein <ag@mediaessenz.eu>
 * @package	TYPO3
 * @subpackage	tx_megooglecalendar
 */
class tx_megooglecalendar_pi1 extends tslib_pibase {
	public $prefixId      = 'tx_megooglecalendar_pi1';
	public $scriptRelPath = 'pi1/class.tx_megooglecalendar_pi1.php';
	public $extKey        = 'me_google_calendar';
	public $pi_checkCHash = true;
	public $contentKey = null;
	public $jsFiles = array();
	public $js = array();
	public $cssFiles = array();
	public $css = array();
	public $titles = array();
	public $attributes = array();
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	public function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
		// Get the Flexform datas
		$this->pi_initPIflexform();
		$piFlexForm = $this->cObj->data['pi_flexform'];
		foreach ($piFlexForm['data'] as $sheet => $data) {
            foreach ($data as $lang => $value) {
                foreach ($value as $key => $val) {
                    $this->conf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet) ? $this->pi_getFFvalue($piFlexForm, $key, $sheet) : $this->conf[$key];
                }
            }
        }

        // define the key of the element
		$this->setContentKey($this->extKey . "_c" . $this->cObj->data['uid']);
        
       	$this->conf['headerLeft'] = str_replace('[SPACE1]', ' ', $this->conf['headerLeft']);
		$this->conf['headerLeft'] = str_replace('[SPACE2]', ' ', $this->conf['headerLeft']);
		$this->conf['headerLeft'] = str_replace(', ,', ' ', $this->conf['headerLeft']);
		$this->conf['headerLeft'] = str_replace(' ,', ' ', $this->conf['headerLeft']);
		$this->conf['headerLeft'] = str_replace(', ', ' ', $this->conf['headerLeft']);
		$this->conf['headerCenter'] = str_replace('[SPACE1]', ' ', $this->conf['headerCenter']);
		$this->conf['headerCenter'] = str_replace('[SPACE2]', ' ', $this->conf['headerCenter']);
		$this->conf['headerCenter'] = str_replace(', ,', ' ', $this->conf['headerCenter']);
		$this->conf['headerCenter'] = str_replace(' ,', ' ', $this->conf['headerCenter']);
		$this->conf['headerCenter'] = str_replace(', ', ' ', $this->conf['headerCenter']);
		$this->conf['headerRight'] = str_replace('[SPACE1]', ' ', $this->conf['headerRight']);
		$this->conf['headerRight'] = str_replace('[SPACE2]', ' ', $this->conf['headerRight']);
		$this->conf['headerRight'] = str_replace(', ,', ' ', $this->conf['headerRight']);
		$this->conf['headerRight'] = str_replace(' ,', ' ', $this->conf['headerRight']);
		$this->conf['headerRight'] = str_replace(', ', ' ', $this->conf['headerRight']);
		
    	// Add CSS files to resources
		if($this->conf['cssPath']) {
			$this->addCssFile($this->conf['cssPath']);
		}
		if($this->conf['cssThemePath']) {
			$this->addCssFile($this->conf['cssThemePath']);
		}

		$jQueryNoConflict = ($this->conf['jQueryNoConflict']) ? 'jQuery.noConflict();' : '';
		
		// Add JS files to resources
		$this->addJsFile($this->conf['jQueryPluginPath']);
		$this->addJsFile($this->conf['gcalPath']);

		// Get calendar feeds from db
		$eventSources = array();
		$this->conf['pids'] = $this->pi_getPidList($this->conf['pages'], $this->conf['recursive']);
		$where = 'deleted=0 AND hidden=0 AND pid IN (' . $this->conf['pids'] . ')';
	    $fields = 'title,url,timezone,css';
	    $table = 'tx_megooglecalendar_feeds';
	    $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($fields,$table,$where,$groupBy='',$orderBy,$limit='');
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$url = $this->cObj->typoLink('', array('parameter' => $row['url'], 'returnLast' => 'url'));
			$eventSources[] = 'jQuery.fullCalendar.gcalFeed(\'' . $url . '\',{className: \'' . $row['css'] . '\',currentTimezone: \'' . $row['timezone'] . '\'})';
		}

		
		// Add fullCalendar configuration to resources
		$this->addJS('
		if(!console || !console.log) {
			var console = new Array();
			console.log = function () {}
		}
		' . $jQueryNoConflict . '
		jQuery.extend({URLEncode:function(c){var o=\'\';var x=0;c=c.toString();var r=/(^[a-zA-Z0-9_.]*)/;
		  while(x<c.length){var m=r.exec(c.substr(x));
		    if(m!=null && m.length>1 && m[1]!=\'\'){o+=m[1];x+=m[1].length;
		    }else{if(c[x]==\' \')o+=\'+\';else{var d=c.charCodeAt(x);var h=d.toString(16);
		    o+=\'%\'+(h.length<2?\'0\':\'\')+h.toUpperCase();}x++;}}return o;},
		URLDecode:function(s){var o=s;var binVal,t;var r=/(%[^%]{2})/;
		  while((m=r.exec(o))!=null && m.length>1 && m[1]!=\'\'){b=parseInt(m[1].substr(1),16);
		  t=String.fromCharCode(b);o=o.replace(m[1],t);}return o;}
		});
		var dayNamesLocal = [\'' . htmlspecialchars($this->pi_getLL('sunday')) . '\',\'' . htmlspecialchars($this->pi_getLL('monday')) . '\',\'' . htmlspecialchars($this->pi_getLL('tuesday')) . '\',\'' . htmlspecialchars($this->pi_getLL('wednesday')) . '\',\'' . htmlspecialchars($this->pi_getLL('thursday')) . '\',\'' . htmlspecialchars($this->pi_getLL('friday')) . '\',\'' . htmlspecialchars($this->pi_getLL('saturday')) . '\'];
		var dayNamesShortLocal = [\'' . htmlspecialchars($this->pi_getLL('sun')) . '\',\'' . htmlspecialchars($this->pi_getLL('mon')) . '\',\'' . htmlspecialchars($this->pi_getLL('tue')) . '\',\'' . htmlspecialchars($this->pi_getLL('wed')) . '\',\'' . htmlspecialchars($this->pi_getLL('thu')) . '\',\'' . htmlspecialchars($this->pi_getLL('fri')) . '\',\'' . htmlspecialchars($this->pi_getLL('sat')) . '\'];
		var monthNamesLocal = [\'' . htmlspecialchars($this->pi_getLL('january')) . '\',\'' . htmlspecialchars($this->pi_getLL('february')) . '\',\'' . htmlspecialchars($this->pi_getLL('march')) . '\',\'' . htmlspecialchars($this->pi_getLL('april')) . '\',\'' . htmlspecialchars($this->pi_getLL('may')) . '\',\'' . htmlspecialchars($this->pi_getLL('june')) . '\',\'' . htmlspecialchars($this->pi_getLL('july')) . '\',\'' . htmlspecialchars($this->pi_getLL('august')) . '\',\'' . htmlspecialchars($this->pi_getLL('september')) . '\',\'' . htmlspecialchars($this->pi_getLL('october')) . '\',\'' . htmlspecialchars($this->pi_getLL('november')) . '\',\'' . htmlspecialchars($this->pi_getLL('december')) . '\'];
		var monthNamesShortLocal = [\'' . htmlspecialchars($this->pi_getLL('jan')) . '\',\'' . htmlspecialchars($this->pi_getLL('feb')) . '\',\'' . htmlspecialchars($this->pi_getLL('mar')) . '\',\'' . htmlspecialchars($this->pi_getLL('apr')) . '\',\'' . htmlspecialchars($this->pi_getLL('may_short')) . '\',\'' . htmlspecialchars($this->pi_getLL('jun')) . '\',\'' . htmlspecialchars($this->pi_getLL('jul')) . '\',\'' . htmlspecialchars($this->pi_getLL('aug')) . '\',\'' . htmlspecialchars($this->pi_getLL('sep')) . '\',\'' . htmlspecialchars($this->pi_getLL('oct')) . '\',\'' . htmlspecialchars($this->pi_getLL('nov')) . '\',\'' . htmlspecialchars($this->pi_getLL('dec')) . '\'];
		jQuery(document).ready(function(){
			jQuery("#' . $this->getContentKey() . '").fullCalendar({
				theme: ' . ($this->conf['cssThemePath'] ? 'true' : 'false') . ',
				eventSources: [' . implode(',',$eventSources) . '],
				header: ' . ($this->conf['hideHeader'] ? 'false' : '{left: \'' . $this->conf['headerLeft'] . '\',center: \'' . $this->conf['headerCenter'] . '\',right: \'' . $this->conf['headerRight'] . '\'}') . ',
				weekMode: \'' . $this->conf['weekMode'] . '\',
				defaultView: \'' . $this->conf['defaultView'] . '\',
				weekends: ' . ($this->conf['weekends'] ? 'true' : 'false') . ',
				allDaySlot: ' . ($this->conf['allDaySlot'] ? 'true' : 'false') . ',
				minTime: ' . $this->conf['minTime'] . ',
				maxTime: ' . $this->conf['maxTime'] . ',
				firstDay: ' . $this->conf['firstDay'] . ',
				titleFormat: {month: "' . $this->conf['titleFormatMonth'] . '",week: "' . $this->conf['titleFormatWeek'] . '",day: "' . $this->conf['titleFormatDay'] . '"},
				columnFormat: {month: "' . $this->conf['columnFormatMonth'] . '",week: "' . $this->conf['columnFormatWeek'] . '",day: "' . $this->conf['columnFormatDay'] . '"},
				timeFormat: {agenda: "' . $this->conf['timeFormatAgenda'] . '",\'\': "' . $this->conf['timeFormatGeneral'] . '"},
				axisFormat: "' . $this->conf['timeFormatAxis'] . '",
				monthNames: monthNamesLocal,
				monthNamesShort: monthNamesShortLocal,
				dayNames: dayNamesLocal,
				dayNamesShort: dayNamesShortLocal,
				allDayText: \'' . htmlspecialchars($this->pi_getLL('alldaytext')) . '\',
				buttonText: {prev: \'' . ($this->pi_getLL('buttontext_prev')) . '\',next: \'' . ($this->pi_getLL('buttontext_next')) . '\',prevYear: \'' . ($this->pi_getLL('buttontext_prev_year')) . '\',nextYear: \'' . ($this->pi_getLL('buttontext_next_year')) . '\',today: \'' . htmlspecialchars($this->pi_getLL('buttontext_today')) . '\',month: \'' . htmlspecialchars($this->pi_getLL('buttontext_month')) . '\',week: \'' . htmlspecialchars($this->pi_getLL('buttontext_week')) . '\',day: \'' . htmlspecialchars($this->pi_getLL('buttontext_day')) . '\'},
				firstHour: ' . $this->conf['firstHour'] . ',
				eventClick: function(event) { 
					//var eventUrl = jQuery.URLEncode(event.url);
					var eventDialog = jQuery("#' . $this->getContentKey() . '_dialog");
					eventDialog.find("*").remove();
					var eventDay = jQuery.fullCalendar.formatDate(event.start, "' . $this->conf['columnFormatDay'] . '", {dayNames: dayNamesLocal});
					var eventStart = jQuery.fullCalendar.formatDate(event.start, "' . $this->conf['timeFormatGeneral'] . '");
					var eventEnd = jQuery.fullCalendar.formatDate(event.end, "' . $this->conf['timeFormatGeneral'] . '");
					var downloadIcal = "' . ($this->conf['hideIcalDownloadButton'] ? '' : '<a href=\"" + event.ical + "\" title=\"' . $this->pi_getLL('event_download_ical_title') . '\" class=\"fc-icalbutton\">' . $this->pi_getLL('event_download_ical') . '</a>') . '";
					var addToGoogleCal = "' . ($this->conf['hideAddtoGoogleCalendarButton'] ? '' : '<a href=\"" + event.url + "\" title=\"' . $this->pi_getLL('event_add_to_google_title') . '\" class=\"fc-addtogooglebutton\">' . $this->pi_getLL('event_add_to_google') . '</a>') . '";
					var eventButtons = "";
					if(downloadIcal != "" || addToGoogleCal != "") {
						eventButtons = "<div class=\"fc-buttons\">" + downloadIcal + addToGoogleCal + "</div>";
					}
					var eventLocation = "";
					if(event.location != "") {
						eventLocation += "<dt>' . $this->pi_getLL('event_location') . '</dt><dd>";
						eventLocation += "' . ($this->conf['noGoogleMapsLink'] ? '' : '<a href=\"http://maps.google.com/maps?q=" + jQuery.URLEncode(event.location) + "\" target=\"googlemaps\" title=\"' . $this->pi_getLL('event_location_google_maps_link_title') . '\">') . '";
						eventLocation += event.location;
						eventLocation += "' . ($this->conf['noGoogleMapsLink'] ? '' : '</a>') . '";
						eventLocation += "</dd>";
					}
					eventDialog.append(\'<div class="fc-description">\' + event.description + \'</div><dl><dt>' . $this->pi_getLL('event_duration') . '</dt><dd>\' + eventDay + \'&nbsp;&nbsp;\' + eventStart +  \'&nbsp;–&nbsp;\' + eventEnd + \'</dd>\' + eventLocation + \'</dl>\' + eventButtons)
						.dialog({
							title: event.title,
							width: 400
						});
					jQuery("a.fc-icalbutton").button({ icons: {primary: "ui-icon-circle-arrow-s"}});
					jQuery("a.fc-addtogooglebutton").button({ icons: {primary: "ui-icon-circle-plus"}});
					return false;
				},
				loading: function(bool) {
					if (bool) {
						jQuery(\'#' . $this->getContentKey() . '_loading\').show();
					} else {
						jQuery(\'#' . $this->getContentKey() . '_loading\').hide();
					}
				}
			});
			jQuery(\'#' . $this->getContentKey() . '_loading\').position({of: jQuery(\'#' . $this->getContentKey() . '\'),my: \'center middle\',at: \'center middle\'});
			' . ($this->conf['hideTitle'] ? 'jQuery(\'#' . $this->getContentKey() . ' .fc-view table thead\').hide();' : '') . '
		});
		');
		
		// Add some div containers needed by fullCalendar plugin
		// Todo: put this into a template file
		$content = '<div id="' . $this->getContentKey() . '_loading" class="fc-loading ui-widget ui-widget-content ui-corner-all" style="display:none">' . $this->pi_getLL('loading', 'loading...') . '</div><div id="' . $this->getContentKey() . '" class="fc-calendar"></div><div id="' . $this->getContentKey() . '_dialog" class="fc-dialog" style="display:none"></div>';

		// Add all resources
		$this->addResources();
		
		return $this->pi_wrapInBaseClass($content);
	}

	/**
	 * Set the contentKey
	 * @param string $contentKey
	 */
	public function setContentKey($contentKey=null)	{
		$this->contentKey = ($contentKey == null ? $this->extKey : $contentKey);
	}

	/**
	 * Get the contentKey
	 * @return string
	 */
	public function getContentKey()	{
		return $this->contentKey;
	}

	/**
	 * Include all defined resources (JS / CSS)
	 *
	 * @return void
	 */
	public function addResources()	{
		// checks if t3jquery is loaded
		if (T3JQUERY === true) {
			tx_t3jquery::addJqJS();
		} else {
			if(!$this->conf['enableGlobal']) {
				$this->addJsFile($this->conf['jQueryPath'], true);
			}
			if(!$this->conf['enableUiGlobal']) {
				$this->addJsFile($this->conf['jQueryUiPath']);
			}
		}
		if (t3lib_div::int_from_ver(TYPO3_version) >= 4003000) {
			$pagerender = $GLOBALS['TSFE']->getPageRenderer();
		}
		// Fix moveJsFromHeaderToFooter (add all scripts to the footer)
		if ($GLOBALS['TSFE']->config['config']['moveJsFromHeaderToFooter']) {
			$allJsInFooter = true;
		} else {
			$allJsInFooter = false;
		}
		// add all defined JS files
		if (count($this->jsFiles) > 0) {
			foreach ($this->jsFiles as $jsToLoad) {
				if (T3JQUERY === true) {
					$conf = array(
						'jsfile' => $jsToLoad,
						'tofooter' => ($this->conf['jsInFooter'] || $allJsInFooter),
						'jsminify' => $this->conf['jsMinify'],
					);
					tx_t3jquery::addJS('', $conf);
				} else {
					$file = $this->getPath($jsToLoad);
					if ($file) {
						if (t3lib_div::int_from_ver(TYPO3_version) >= 4003000) {
							if ($allJsInFooter) {
								$pagerender->addJsFooterFile($file, $type, $this->conf['jsMinify']);
							} else {
								$pagerender->addJsFile($file, $type, $this->conf['jsMinify']);
							}
						} else {
							$temp_file = '<script type="text/javascript" src="' . $file . '"></script>';
							if ($allJsInFooter) {
								$GLOBALS['TSFE']->additionalFooterData['jsFile_' . $this->extKey . '_' . $file] = $temp_file;
							} else {
								$GLOBALS['TSFE']->additionalHeaderData['jsFile_' . $this->extKey . '_' . $file] = $temp_file;
							}
						}
					} else {
						t3lib_div::devLog("'{$jsToLoad}' does not exists!", $this->extKey, 2);
					}
				}
			}
		}
		// add all defined JS script
		if (count($this->js) > 0) {
			foreach ($this->js as $jsToPut) {
				$temp_js .= $jsToPut;
			}
			$conf = array();
			$conf['jsdata'] = $temp_js;
			if (T3JQUERY === true && t3lib_div::int_from_ver($this->getExtensionVersion('t3jquery')) >= 1002000) {
				$conf['tofooter'] = ($this->conf['jsInFooter'] || $allJsInFooter);
				$conf['jsminify'] = $this->conf['jsMinify'];
				$conf['jsinline'] = $this->conf['jsInline'];
				tx_t3jquery::addJS('', $conf);
			} else {
				// Add script only once
				$hash = md5($temp_js);
				if ($this->conf['jsInline']) {
					$GLOBALS['TSFE']->inlineJS[$hash] = $temp_css;
				} elseif (t3lib_div::int_from_ver(TYPO3_version) >= 4003000) {
					if ($this->conf['jsInFooter'] || $allJsInFooter) {
						$pagerender->addJsFooterInlineCode($hash, $temp_js, $this->conf['jsMinify']);
					} else {
						$pagerender->addJsInlineCode($hash, $temp_js, $this->conf['jsMinify']);
					}
				} else {
					if ($this->conf['jsMinify']) {
						$temp_js = t3lib_div::minifyJavaScript($temp_js);
					}
					if ($this->conf['jsInFooter'] || $allJsInFooter) {
						$GLOBALS['TSFE']->additionalFooterData['js_' . $this->extKey . '_'.$hash] = t3lib_div::wrapJS($temp_js, true);
					} else {
						$GLOBALS['TSFE']->additionalHeaderData['js_' . $this->extKey.'_' . $hash] = t3lib_div::wrapJS($temp_js, true);
					}
				}
			}
		}
		// add all defined CSS files
		if (count($this->cssFiles) > 0) {
			foreach ($this->cssFiles as $cssToLoad) {
				// Add script only once
				$file = $this->getPath($cssToLoad);
				if ($file) {
					if (t3lib_div::int_from_ver(TYPO3_version) >= 4003000) {
						$pagerender->addCssFile($file, 'stylesheet', 'all', '', $this->conf['cssMinify']);
						t3lib_div::devLog(var_export($file, true), $this->extKey, 2);
					} else {
						$GLOBALS['TSFE']->additionalHeaderData['cssFile_' . $this->extKey . '_' . $file] = '<link rel="stylesheet" type="text/css" href="' . $file . '" media="all" />' . chr(10);
					}
				} else {
					t3lib_div::devLog("'{$cssToLoad}' does not exists!", $this->extKey, 2);
				}
			}
		}
		// add all defined CSS Script
		if (count($this->css) > 0) {
			foreach ($this->css as $cssToPut) {
				$temp_css .= $cssToPut;
			}
			$hash = md5($temp_css);
			if (t3lib_div::int_from_ver(TYPO3_version) >= 4003000) {
				$pagerender->addCssInlineBlock($hash, $temp_css, $this->conf['cssMinify']);
			} else {
				// addCssInlineBlock
				$GLOBALS['TSFE']->additionalCSS['css_' . $this->extKey . '_' . $hash] .= $temp_css;
			}
		}
	}

	/**
	 * Return the webbased path
	 * 
	 * @param string $path
	 * return string
	 */
	protected function getPath($path="")
	{
		return $GLOBALS['TSFE']->tmpl->getFileName($path);
	}

	/**
	 * Add additional JS file
	 * 
	 * @param string $script
	 * @param boolean $first
	 * @return void
	 */
	protected function addJsFile($script="", $first=false)
	{
		$script = t3lib_div::fixWindowsFilePath($script);
		if ($this->getPath($script) && ! in_array($script, $this->jsFiles)) {
			if ($first === true) {
				$this->jsFiles = array_merge(array($script), $this->jsFiles);
			} else {
				$this->jsFiles[] = $script;
			}
		}
	}

	/**
	 * Add JS to header
	 * 
	 * @param string $script
	 * @return void
	 */
	protected function addJS($script="")
	{
		if (! in_array($script, $this->js)) {
			$this->js[] = $script;
		}
	}

	/**
	 * Add additional CSS file
	 * 
	 * @param string $script
	 * @return void
	 */
	protected function addCssFile($script="")
	{
		$script = t3lib_div::fixWindowsFilePath($script);
		if ($this->getPath($script) && ! in_array($script, $this->cssFiles)) {
			$this->cssFiles[] = $script;
		}
	}

	/**
	 * Add CSS to header
	 * 
	 * @param string $script
	 * @return void
	 */
	protected function addCSS($script="")
	{
		if (! in_array($script, $this->css)) {
			$this->css[] = $script;
		}
	}

	/**
	 * Returns the version of an extension (in 4.4 its possible to this with t3lib_extMgm::getExtensionVersion)
	 * @param string $key
	 * @return string
	 */
	protected function getExtensionVersion($key)
	{
		if (! t3lib_extMgm::isLoaded($key)) {
			return '';
		}
		$_EXTKEY = $key;
		include(t3lib_extMgm::extPath($key) . 'ext_emconf.php');
		return $EM_CONF[$key]['version'];
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/me_google_calendar/pi1/class.tx_megooglecalendar_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/me_google_calendar/pi1/class.tx_megooglecalendar_pi1.php']);
}

?>
