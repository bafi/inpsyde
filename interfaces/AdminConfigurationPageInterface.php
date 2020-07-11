<?php
declare( strict_types=1 );

namespace Inpsyde\Interfaces;

interface AdminConfigurationPageInterface
{
    /**
     * Add hooks
     */
    public function addHooks(): void;

    /**
     * Add Inpsyde configuration page
     */
    public function addConfigurationPage(): void;

    /**
     * Register and add settings
     */
    public function addConfigurationPageContent(): void;
}
