<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 * @implements \Rembrandt\QueryJoinInterface
 */
trait JoinQueryBuilderTrait
{
    /**
     * @psalm-var list<array{type: string, joinTable: string, myKey: string, relationKey: string}>
     */
    private array $joinList = [];

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function innerJoin(string $joinTable, string $myKey, string $relationKey): static
    {
        $type = 'INNER';
        $this->joinList[] = \compact(
            'type',
            'joinTable',
            'myKey',
            'relationKey',
        );
        return $this;
    }

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function leftOuterJoin(string $joinTable, string $myKey, string $relationKey): static
    {
        $type = 'LEFT OUTER';
        $this->joinList[] = \compact(
            'type',
            'joinTable',
            'myKey',
            'relationKey',
        );
        return $this;
    }

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function rightOuterJoin(string $joinTable, string $myKey, string $relationKey): static
    {
        $type = 'RIGHT OUTER';
        $this->joinList[] = \compact(
            'type',
            'joinTable',
            'myKey',
            'relationKey',
        );
        return $this;
    }

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function fullOuterJoin(string $joinTable, string $myKey, string $relationKey): static
    {
        $type = 'FULL OUTER';
        $this->joinList[] = \compact(
            'type',
            'joinTable',
            'myKey',
            'relationKey',
        );
        return $this;
    }

    private function buildJoin(): string
    {
        $lines = [];
        foreach ($this->joinList as $join) {
            $lines[] = \sprintf(
                '%s `%s` ON `%s`.`%s` = `%s`.`%s`',
                $join['type'],
                $this->getBaseTableName(),
                $this->getBaseTableName(),
                $join['myKey'],
                $join['joinTable'],
                $join['relationKey'],
            );
        }

        return \implode(' ', $lines);
    }

    abstract private function getBaseTableName(): string;
}
