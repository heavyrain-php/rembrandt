<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 * @implements \Rembrandt\QuerySelectInterface
 */
trait SelectQueryBuilderTrait
{
    /** @psalm-var string[] */
    private array $selectList = [];

    /**
     * Adds SELECT with escaped columns
     * @param array $columns
     * @psalm-param string[] $columns
     * @return static
     */
    public function select(array $columns): static
    {
        $this->selectList = [];
        foreach ($columns as $column) {
            $this->selectList[] = \sprintf('`%s`', $column);
        }

        return $this;
    }

    /**
     * Adds SELECT with raw columns
     * @param array $columns
     * @psalm-param string[] $columns
     * @return static
     */
    public function selectRaw(array $columns): static
    {
        $this->selectList = $columns;
        return $this;
    }

    private function buildSelect(): string
    {
        if (\count($this->selectList) === 0) {
            return 'SELECT *';
        }
        return \sprintf('SELECT %s', \implode(', ', $this->selectList));
    }
}
