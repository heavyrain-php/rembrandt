<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 */
interface QueryOrderByInterface
{
    /**
     * Adds ORDER BY foo DESC, bar DESC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function orderByDesc(string|array $columns): static;

    /**
     * Adds ORDER BY foo ASC, bar ASC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function orderByAsc(string|array $columns): static;

    /**
     * Adds ORDER BY foo DESC, bar ASC
     * ```php
     * $builder->orderBy(['user_id', 'DESC'], ['updated_at', 'ASC']);
     * ```
     * @param array $columns
     * @psalm-param list<list{string, 'ASC'|'DESC'}> $columns
     * @return static
     */
    public function orderBy(array $columns): static;
}
