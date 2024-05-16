<?php
/**
 * @wordpress-plugin
 * Plugin Name: Gravity Forms Currency Selector
 * Plugin URI: https://gravityplus.pro/
 * Description: Allow users to select and be charged in their desired currency.
 * Version: 1.4.1
 * Author: gravity+
 * Author URI: https://gravityplus.pro
 * Text Domain: gravityplus-currency-selector
 * Domain Path: /languages
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package   GFP_Currency_Selector
 * @version   1.4.1
 * @author    gravity+ <support@gravityplus.pro>
 * @license   GPL-2.0+
 * @link      https://gravityplus.pro
 * @copyright 2015-2021 gravity+
 *
 * last updated: August 30, 2021
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Setup Constants

/**
 * Plugin version, used for cache-busting of style and script file references.
 *
 * @since   1.0.0
 */
define( 'GFP_CURRENCY_SELECTOR_CURRENT_VERSION', '1.4.1' );

/**
 * Unique identifier
 *
 * @since 1.0.0
 */
define( 'GFP_CURRENCY_SELECTOR_SLUG', plugin_basename( dirname( __FILE__ ) ) );

define( 'GFP_CURRENCY_SELECTOR_FILE', __FILE__ );

define( 'GFP_CURRENCY_SELECTOR_PATH', plugin_dir_path( __FILE__ ) );

define( 'GFP_CURRENCY_SELECTOR_URL', plugin_dir_url( __FILE__ ) );

//Let's get it started! Load all of the necessary class files for the plugin
require_once( 'includes/class-loader.php' );
GFP_Currency_Selector_Loader::load();

$gravityplus_currency_selector = new GFP_Currency_Selector();
$gravityplus_currency_selector->run();