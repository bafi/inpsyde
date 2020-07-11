<?php
declare( strict_types=1 );

namespace Inpsyde\admin;

use Inpsyde\Includes\InpsydeCore;
use Inpsyde\Interfaces\AdminConfigurationPageInterface;

/**
 * The admin-specific functionality of the plugin.
 */
class AdminConfigurationPage implements AdminConfigurationPageInterface
{

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Page title
     *
     * @var string
     */
    private $pageTitle = 'Inpsyde configuration';

    /**
     * Page slug
     *
     * @var string
     */
    private $page = 'inpsyde-configuration';

    /**
     * Hold the option name that saved in DB
     *
     * @var string
     */
    private $optionName = 'inpsyde_configuration';

    /**
     * Hold the settings fields
     *
     * @var \string[][]
     */
    private $settingsFields = [
        [
            'id' => 'front_page_uri',
            'title' => 'Front page URI',
            'callback' => 'frontpageURICallback',
        ],
        [
            'id' => 'url',
            'title' => 'URL',
            'callback' => 'URLCallback',
        ],
    ];

    /**
     * Add hooks
     */
    public function addHooks():void
    {
        add_action('admin_menu', [ $this, 'addConfigurationPage' ]);
        add_action('admin_init', [ $this, 'addConfigurationPageContent' ]);
    }

    /**
     * Add Inpsyde configuration page
     */
    public function addConfigurationPage():void
    {
        $function = [ $this, 'createAdminPage' ];
        $iconClass = 'dashicons-admin-settings';
        $capability = 'manage_options';
        add_menu_page($this->pageTitle, 'Inpsyde', $capability, $this->page, $function, $iconClass, 4);
    }

    /**
     * Options page callback
     */
    public function createAdminPage():void
    {
        // Set class property
        $this->options = get_option($this->optionName);
        include_once InpsydeCore::adminTemplatePath() . 'configuration_template.php';
    }

    /**
     * Register and add settings
     */
    public function addConfigurationPageContent():void
    {
        add_settings_section('inpsyde_configuration_section', null, null, 'inpsyde-configuration');

        register_setting($this->page, $this->optionName, [
            $this,
            'sanitize',
        ]);

        // Loop on settings fields
        foreach ($this->settingsFields as $settingsField) {
            add_settings_field(
                $settingsField['id'],
                $settingsField['title'],
                [ $this, $settingsField['callback'] ],
                $this->page,
                'inpsyde_configuration_section'
            );
        }
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $inputs Contains all settings fields as array keys
     */
    public function sanitize(array $inputs):array
    {
        $output = [];
        if (isset($inputs['front_page_uri']) && !empty($inputs['front_page_uri'])) {
            $output['front_page_uri'] = trim(sanitize_text_field($inputs['front_page_uri']), '/');
        }

        if (isset($inputs['url']) && !empty($inputs['url'])) {
            $url = wp_http_validate_url($inputs['url']);
            // Check URL is valid and exist
            if (!$url) {
                $message = __('Please enter a valid URL.', 'inspyde');
                add_settings_error($this->page, 'front_page_uri', $message, 'error');
            }

            if ($url) {
                $output['url'] = trim($url, '/');
            }
        }

        if ($this->checkKeyIssetAndNotEmpty($inputs, 'front_page_uri')) {
            // Set default end point for is it's not presented
            $message = __('The default front page URL is testing.', 'inspyde');
            add_settings_error($this->page, 'front_page_uri', $message, 'warning');
            $output['front_page_uri'] = 'testing';
        }

        if ($this->checkKeyIssetAndNotEmpty($inputs, 'url')) {
            // Set default URL if it's not presented
            $message = __('The default URL is <i><a target="_blank" href="https://jsonplaceholder.typicode.com">https://jsonplaceholder.typicode.com</a></i>.', 'inspyde');
            add_settings_error($this->page, 'url', $message, 'warning');
            $output['url'] = 'https://jsonplaceholder.typicode.com';
        }
        flush_rewrite_rules();

        return $output;
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function frontpageURICallback():void
    {
        printf(
            '<input type="text" id="front_page_uri" name="inpsyde_configuration[front_page_uri]" value="%s" 
/>',
            isset($this->options['front_page_uri']) ? esc_attr($this->options['front_page_uri']) : ''
        );
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function URLCallback()
    {
        printf(
            '<input type="text" id="url" name="inpsyde_configuration[url]" value="%s" />',
            isset($this->options['url']) ? esc_attr($this->options['url']) : ''
        );
    }

    /**
     * Check array is set and not empty
     *
     * @param array $array
     * @param string $key
     *
     * @return bool
     */
    private function checkKeyIssetAndNotEmpty(array $array, string $key):bool
    {
        return (!isset($array[$key]) || empty($array[$key]));
    }
}
