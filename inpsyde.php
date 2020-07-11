<?php
declare( strict_types=1 );
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.linkedin.com/in/moustafagouda/
 * @since             1.0.0
 * @package           Inpsyde
 *
 * @wordpress-plugin
 * Plugin Name:       Inpsyde
 * Plugin URI:        https://github.com/bafi/inpsyde
 * Description:       This plugin is created for Inpsyde technical assessment purpose
 * Version:           1.0.0
 * Author:            MGO
 * Author URI:        https://www.linkedin.com/in/moustafagouda/
 * License:           GPL-3.0-only
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       inpsyde
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
const INPSYDE_VERSION = '1.0.0';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require dirname(__FILE__) . '/includes/InpsydeCore.php';

// Begins execution of the plugin.
new \Inpsyde\Includes\InpsydeCore();
