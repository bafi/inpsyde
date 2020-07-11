<?php
declare( strict_types=1 );

namespace Inpsyde\Interfaces;

interface FrontUserPageInterface
{
    /**
     * Add hooks
     */
    public function addFilters(): void;

    /**
     * @param $defaultTemplate
     *
     * @return string
     */
    public function includeTemplate(string $defaultTemplate): string;

    /**
     * Register new route
     */
    public function rewriteRules(): void;
}
