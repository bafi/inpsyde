<?php
declare( strict_types=1 );

namespace Inpsyde\Includes;

use Inpsyde\admin\AdminConfigurationPage;
use Inpsyde\front\FrontUserPage;

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
        $this->defineFrontFilters();
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

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once dirname(__FILE__) . '/../interfaces/FrontUserPageInterface.php';
        require_once dirname(__FILE__) . '/../front/FrontUserPage.php';
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
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     */
    private function defineFrontFilters()
    {
	    (new FrontUserPage())->addFilters();
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
