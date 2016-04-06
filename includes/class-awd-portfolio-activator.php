<?php

/**
 * Fired during plugin activation
 *
 * @link              http://anarchywebdev.com/
 * @since             1.0.0
 * @package           awd_portfolio
 * 
 */
class AWD_Portfolio_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();

	}

}
