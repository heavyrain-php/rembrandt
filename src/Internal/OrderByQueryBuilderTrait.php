<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 * @implements \Rembrandt\QueryOrderByInterface
 */
trait OrderByQueryBuilderTrait
{
    /** @var list<array{column: string, order: 'ASC'|'DESC'}> */
    private array $orderByList = [];

    /**
     * Adds ORDER BY foo DESC, bar DESC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function orderByDesc(string|array $columns): static
    {
        $c = \is_array($columns) ? $columns : [$columns];
        $this->orderByList = [];
        foreach ($c as $column) {
            $this->orderByList[] = [
                'column' => $column,
                'order' => 'DESC',
            ];
        }
        return $this;
    }

    /**
     * Adds ORDER BY foo ASC, bar ASC
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function orderByAsc(string|array $columns): static
    {
        $c = \is_array($columns) ? $columns : [$columns];
        $this->orderByList = [];
        foreach ($c as $column) {
            $this->orderByList[] = [
                'column' => $column,
                'order' => 'ASC',
            ];
        }
        return $this;
    }

    /**
     * Adds ORDER BY foo DESC, bar ASC
     * ```php
     * $builder->orderBy(['user_id', 'DESC'], ['updated_at', 'ASC']);
     * ```
     * @param array $columns
     * @psalm-param list<list{string, 'ASC'|'DESC'}> $columns
     * @return static
     */
    public function orderBy(array $columns): static
    {
        $this->orderByList = [];
        foreach ($columns as $column) {
            $this->orderByList[] = [
                'column' => $column[0],
                'order' => $column[1],
            ];
        }
        return $this;
    }

    private function buildOrderBy(): string
    {
        if (\count($this->orderByList) === 0) {
            return '';
        }

        $lines = [];
        foreach ($this->orderbyList as $orderBy) {
            $lines[] = \sprintf('`%s` %s', $orderBy['column'], $orderBy['order']);
        }
        return \sprintf('ORDER BY %s', \implode(', ', $lines));
    }
}
