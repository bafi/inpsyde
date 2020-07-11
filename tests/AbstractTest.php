<?php
declare( strict_types=1 );

namespace Tests;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

abstract class AbstractTest extends TestCase
{

    /**
     * Setup
     */
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
        $this->requirePlugin();
    }

    /**
     * Tear Down
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * Load all plugin files
     */
    private function requirePlugin(): void
    {
        if (! defined('WPINC')) {
            define('WPINC', 'wp-include');
        }
        require_once __DIR__ . '/../inpsyde.php';
    }
}
