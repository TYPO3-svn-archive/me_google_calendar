<?php

class Tx_MeGoogleCalendar_ViewHelpers_Div_JsBoolViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
	/**
	 * @return string
	 */
	public function render() {
		$code = $this->renderChildren();

		return (empty($code))  ? 'false' : 'true';
	}
}

?>