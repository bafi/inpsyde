<?php
declare( strict_types=1 );

namespace Tests\Unit;

use Inpsyde\admin\AdminConfigurationPage;
use Inpsyde\Interfaces\AdminConfigurationPageInterface;
use Tests\AbstractTest;

class AdminConfigurationTest extends AbstractTest
{

    /**
     * Check the admin class has been implemented the interfaces
     */
    public function testAdminConfigurationImplementedInterface()
    {
        $adminClass = new AdminConfigurationPage();
        $checked = $adminClass instanceof AdminConfigurationPageInterface;
        $this->assertTrue($checked, 'Admin settings class implemented interfaces.');
    }

    /**
     * Check hooks admin menu is called
     */
    public function testHasAdminMenuAction()
    {
        $adminClass = new AdminConfigurationPage();
        $adminClass->addHooks();
        $hasAction = has_action('admin_menu', [
            $adminClass,
            'addConfigurationPage',
        ]);
        $this->assertTrue($hasAction, 'Admin settings class has admin_menu action.');
    }

    /**
     * Check hooks admin init is called
     */
    public function testHasAdminInitAction()
    {
        $adminClass = new AdminConfigurationPage();
        $adminClass->addHooks();
        $hasAction = has_action('admin_init', [
            $adminClass,
            'addConfigurationPageContent',
        ]);

        $this->assertTrue($hasAction, 'Admin settings class has admin_init action.');
    }
}
