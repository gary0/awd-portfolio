<?php

/**
 * Fired during plugin deactivation
 *
 * @link              http://anarchywebdev.com/
 * @since             1.0.0
 * @package           awd_portfolio
 * 
 */
class AWD_Portfolio_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();

	}

}
