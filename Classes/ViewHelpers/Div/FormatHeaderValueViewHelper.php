<?php

class Tx_MeGoogleCalendar_ViewHelpers_Div_FormatHeaderValueViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @return string
	 */
	public function render() {
		$code = $this->renderChildren();
		$code = str_replace('[SPACE1]', ' ', $code);
		$code = str_replace('[SPACE2]', ' ', $code);
		$code = str_replace(', ,', ' ', $code);
		$code = str_replace(' ,', ' ', $code);
		$code = str_replace(', ', ' ', $code);

		return trim($code);
	}
}

?>