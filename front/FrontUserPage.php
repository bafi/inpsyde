<?php
declare( strict_types=1 );

namespace Inpsyde\Front;

use Inpsyde\Includes\InpsydeCore;
use Inpsyde\Interfaces\FrontUserPageInterface;

/**
 * The public-facing functionality of the plugin.
 */
class FrontUserPage implements FrontUserPageInterface
{

    /**
     * Add Hooks
     */
    public function addFilters(): void
    {
        add_filter('template_include', [ $this, 'includeTemplate' ]);
        add_filter('init', [ $this, 'rewriteRules' ]);
    }

    /**
     * @param $defaultTemplate
     *
     * @return string
     */
    public function includeTemplate(string $defaultTemplate):string
    {
        if ('1' === (string) get_query_var('render_custom_template')) {
            $cdnMinifiedVueJs = 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js';
            wp_enqueue_script('vuejs', $cdnMinifiedVueJs, [], null, true);
            wp_enqueue_script('inpsyde-js', plugin_dir_url(__FILE__) . 'js/script.js', [], null, true);

            return InpsydeCore::frontTemplatePath() . 'frontpage_template.php';
        }

        return $defaultTemplate;
    }

    /**
     * Register new route
     */
    public function rewriteRules():void
    {
        $config = get_option('inpsyde_configuration');
        $route = 'testing';
        if (isset($config['front_page_uri'])) {
            $route = $config['front_page_uri'];
        }

        add_rewrite_rule("$route/?$", 'index.php?render_custom_template=1', 'top');
        add_rewrite_tag('%render_custom_template%', '([^&]+)');
    }
}
