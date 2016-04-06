<?php

/**
 * Define the internationalization functionality
 *
 * @link              http://anarchywebdev.com/
 * @since             1.0.0
 * @package           awd_portfolio
 * @subpackage awd_portfolio/includes
 */
class AWD_Portfolio_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-name',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
