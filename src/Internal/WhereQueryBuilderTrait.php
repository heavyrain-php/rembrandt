<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

use InvalidArgumentException;

/**
 * @psalm-internal \Rembrandt
 * @implements \Rembrandt\QueryWhereInterface
 */
trait WhereQueryBuilderTrait
{
    /**
     * @var array
     * @psalm-var list<array{
     *   sql: string,
     *   bindings: list<int|float|string>,
     *   connection: 'AND'|'OR'
     * }>
     */
    private array $whereList = [];

    public function where(string $column, string $operator, int|float|string $value): static
    {
        if (!\in_array($operator, ['=', '>', '<', '>=', '<=', '<>'], true)) {
            throw new InvalidArgumentException('where operator is invalid operator=' . $operator);
        }
        $this->whereList[] = [
            'sql' => \sprintf('`%s` %s ?', $column, $operator),
            'bindings' => [$value],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereEquals(string $column, int|float|string $value): static
    {
        return $this->where($column, '=', $value);
    }

    public function whereNotEquals(string $column, int|float|string $value): static
    {
        return $this->where($column, '<>', $value);
    }

    public function whereIn(string $column, array $values): static
    {
        if (count($values) === 0) {
            throw new InvalidArgumentException('values of whereIn query must not be empty');
        }
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IN (%s)', $column, \rtrim(\str_repeat('?, ', \count($values)), ', ')),
            'bindings' => $values,
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereNotIn(string $column, array $values): static
    {
        if (count($values) === 0) {
            throw new InvalidArgumentException('values of whereIn query must not be empty');
        }
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT IN (%s)', $column, \rtrim(\str_repeat('?, ', \count($values)), ', ')),
            'bindings' => $values,
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereIsNull(string $column): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IS NULL', $column),
            'bindings' => [],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereIsNotNull(string $column): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IS NOT NULL', $column),
            'bindings' => [],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereBetween(string $column, int|float $from, int|float $to): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` BETWEEN ? AND ?', $column),
            'bindings' => [$from, $to],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereNotBetween(string $column, int|float $from, int|float $to): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT BETWEEN ? AND ?', $column),
            'bindings' => [$from, $to],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereLike(string $column, string $pattern): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` LIKE ?', $column),
            'bindings' => [$pattern],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function whereNotLike(string $column, string $pattern): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT LIKE ?', $column),
            'bindings' => [$pattern],
            'connection' => 'AND',
        ];
        return $this;
    }

    public function orWhere(string $column, string $operator, int|float|string $value): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` %s ?', $column, $operator),
            'bindings' => [$value],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereEquals(string $column, int|float|string $value): static
    {
        return $this->orWhere($column, '=', $value);
    }

    public function orWhereNotEquals(string $column, int|float|string $value): static
    {
        return $this->orWhere($column, '<>', $value);
    }

    public function orWhereIn(string $column, array $values): static
    {
        if (count($values) === 0) {
            throw new InvalidArgumentException('values of whereIn query must not be empty');
        }
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IN (%s)', $column, \rtrim(\str_repeat('?, ', \count($values)), ', ')),
            'bindings' => $values,
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereNotIn(string $column, array $values): static
    {
        if (count($values) === 0) {
            throw new InvalidArgumentException('values of whereIn query must not be empty');
        }
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT IN (%s)', $column, \rtrim(\str_repeat('?, ', \count($values)), ', ')),
            'bindings' => $values,
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereIsNull(string $column): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IS NULL', $column),
            'bindings' => [],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereIsNotNull(string $column): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` IS NOT NULL', $column),
            'bindings' => [],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereBetween(string $column, int|float $from, int|float $to): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` BETWEEN ? AND ?', $column),
            'bindings' => [$from, $to],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereNotBetween(string $column, int|float $from, int|float $to): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT BETWEEN ? AND ?', $column),
            'bindings' => [$from, $to],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereLike(string $column, string $pattern): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` LIKE ?', $column),
            'bindings' => [$pattern],
            'connection' => 'OR',
        ];
        return $this;
    }

    public function orWhereNotLike(string $column, string $pattern): static
    {
        $this->whereList[] = [
            'sql' => \sprintf('`%s` NOT LIKE ?', $column),
            'bindings' => [$pattern],
            'connection' => 'OR',
        ];
        return $this;
    }

    /**
     * Builds where query
     * @return array
     * @psalm-return array{sql: string, bindings: list<int|float|string>}
     */
    private function buildWhere(): array
    {
        if (\count($this->whereList) === 0) {
            return '';
        }

        $sql = 'WHERE ';
        $bindings = [];

        foreach ($this->whereList as $where) {
            $sql .= \sprintf(
                '%s %s',
                $where['connection'],
                $where['sql'],
            );
            $bindings = array_merge($bindings, $where['bindings']);
        }

        $sql = \ltrim('AND ', \ltrim('OR ', $sql));

        return \compact('sql', 'bindings');
    }
}
