<?php
declare( strict_types=1 );

namespace Tests\Unit;

use Inpsyde\Front\FrontUserPage;
use Inpsyde\Interfaces\FrontUserPageInterface;
use Tests\AbstractTest;

class FrontUserPageTest extends AbstractTest
{

    /**
     * Test front user page implemented the interface
     */
    public function testFronUserPageImplementedInterface()
    {
        $frontClass = new FrontUserPage();
        $checked = $frontClass instanceof FrontUserPageInterface;
        $this->assertTrue($checked, 'Admin settings class implemented interfaces.');
    }

    /**
     * Test filter called and applied to register the new route
     */
    public function testHasInitHookToRegisterNewRoute()
    {
        $frontClass = new FrontUserPage();
        $frontClass->addFilters();

        $hasAction = has_filter('init', [ $frontClass, 'rewriteRules' ]);
        $this->assertTrue($hasAction, 'Front class can rewrite rules for routes.');
    }

    /**
     * Test the default template is rendered of query is not passed
     */
    public function testIfRenderCustomTemplateNotPassed()
    {
        $frontClass = new FrontUserPage();
        $frontClass->addFilters();
        set_query_var('render_custom_template', '0');
        $defaultTemplateName = 'default_template.php';
        $this->assertTrue($defaultTemplateName == $frontClass->includeTemplate($defaultTemplateName), 'It should return the default template file.');
    }

    /**
     * Test the custom template is rendered if the end point is requested
     */
    public function testIfRenderCustomTemplateIsPassed()
    {
        $frontClass = new FrontUserPage();
        $frontClass->addFilters();
        set_query_var('render_custom_template', '1');
        $filePath = $frontClass->includeTemplate('default_template.php');

        $this->assertTrue('frontpage_template.php' === basename($filePath), 'It should return the front user page template.');
    }
}
