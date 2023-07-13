<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

interface QuerySelectInterface
{
    /**
     * Adds SELECT with escaped columns
     * @param array $columns
     * @psalm-param list<string> $columns
     * @return static
     */
    public function select(array $columns): static;

    /**
     * Adds SELECT with raw columns
     * @param array $columns
     * @psalm-param list<string> $columns
     * @return static
     */
    public function selectRaw(array $columns): static;
}
