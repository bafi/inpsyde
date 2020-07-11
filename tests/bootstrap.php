<?php
declare( strict_types=1 );
// phpcs:disable
/**
 * The following snippets uses `PLUGIN` to prefix
 * the constants and class names. You should replace
 * it with something that matches your plugin name.
 */
// define test environment
const PLUGIN_PHPUNIT = true;

// define fake ABSPATH
if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir());
}

require_once __DIR__ . '/../vendor/autoload.php';

// Include the class for PluginTestCase
require_once __DIR__ . '/AbstractTest.php';

// Redefine the query var
function get_query_var(string $key):string
{
    global $queryVar;
    if (isset($queryVar[ $key ])) {
        return $queryVar[ $key ];
    }

    return '';
}

// Redefine the set query var
function set_query_var(string $key, string $value):string
{
    global $queryVar;
    $queryVar[ $key ] = $value;

    return $queryVar[ $key ];
}

// Redefine the plugin URL
function plugin_dir_url():string
{
    return __DIR__ . '/../';
}

// Redefine Enqueue script
function wp_enqueue_script():void
{
}
