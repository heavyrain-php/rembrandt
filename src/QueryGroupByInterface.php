<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

interface QueryGroupByInterface
{
    /**
     * Adds GROUP BY foo DESC, bar DESC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function groupByDesc(string|array $columns): static;

    /**
     * Adds GROUP BY foo ASC, bar ASC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function groupByAsc(string|array $columns): static;

    /**
     * Adds GROUP BY foo DESC, bar ASC
     * ```php
     * $builder->groupBy(['user_id', 'DESC'], ['updated_at', 'ASC']);
     * ```
     * @param array $columns
     * @psalm-param list<list{string, 'ASC'|'DESC'}> $columns
     * @return static
     */
    public function groupBy(array $columns): static;
}
