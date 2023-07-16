<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 */
interface QueryGroupByInterface
{
    /**
     * Adds GROUP BY foo, bar
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function groupBy(string|array $columns): static;
}
