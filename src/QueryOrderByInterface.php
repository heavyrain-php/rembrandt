<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

interface QueryOrderByInterface
{
    /**
     * Adds ORDER BY foo, bar
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function orderBy(string|array $columns): static;
}
