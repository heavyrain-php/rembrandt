<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 * @implements \Rembrandt\QueryGroupByInterface
 */
trait GroupByQueryBuilderTrait
{
    private array $groupByList = [];

    /**
     * Adds GROUP BY foo, bar
     * @param string|array $columns
     * @psalm-param string|string[] $columns
     * @return static
     */
    public function groupBy(string|array $columns): static
    {
        $this->groupByList = [];
        $c = \is_array($columns) ? $columns : [$columns];

        foreach ($c as $column) {
            $this->groupByList[] = \sprintf('`%s`', $column);
        }

        return $this;
    }

    public function buildGroupBy(): string
    {
        if (\count($this->groupByList) === 0) {
            return '';
        }

        return \sprintf('GROUP BY %s', \implode(', ', $this->groupByList));
    }
}
