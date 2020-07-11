<?php
declare( strict_types=1 );

namespace Inpsyde\Includes;

use Inpsyde\admin\AdminConfigurationPage;

/**
 * The core plugin class.
 */
class InpsydeCore
{

    /**
     * The unique identifier of this plugin.
     */
    protected $pluginName;

    /**
     * Inpsyde constructor.
     */
    public function __construct()
    {
        $this->pluginName = 'inpsyde';
        $this->loadDependencies();
        $this->defineAdminHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     */
    private function loadDependencies()
    {
        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once dirname(__FILE__) . '/../interfaces/AdminConfigurationPageInterface.php';
        require_once dirname(__FILE__) . '/../admin/AdminConfigurationPage.php';

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     */
    private function defineAdminHooks()
    {
        (new AdminConfigurationPage())->addHooks();
    }

	/**
	 * Get the plugin root path
	 *
	 * @return string
	 */
    public static function pluginPath(): string
    {
        return dirname(__FILE__) . '/../';
    }

    /**
     * Return the admin template path of plugin
     *
     * @return string
     */
    public static function adminTemplatePath(): string
    {
        return static::pluginPath() . 'admin/templates/';
    }
    /**
     * Return the front template path of plugin
     *
     * @return string
     */
    public static function frontTemplatePath(): string
    {
        return static::pluginPath() . 'front/templates/';
    }
}
