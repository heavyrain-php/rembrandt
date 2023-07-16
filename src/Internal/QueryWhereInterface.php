<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

interface QueryWhereInterface
{
    public function where(string $column, string $operator, int|float|string $value): static;

    public function whereEquals(string $column, int|float|string $value): static;

    public function whereNotEquals(string $column, int|float|string $value): static;

    public function whereIn(string $column, array $values): static;

    public function whereNotIn(string $column, array $values): static;

    public function whereIsNull(string $column): static;

    public function whereIsNotNull(string $column): static;

    public function whereBetween(string $column, int|float $from, int|float $to): static;

    public function whereNotBetween(string $column, int|float $from, int|float $to): static;

    public function whereLike(string $column, string $pattern): static;

    public function whereNotLike(string $column, string $pattern): static;



    public function orWhere(string $column, string $operator, int|float|string $value): static;

    public function orWhereEquals(string $column, int|float|string $value): static;

    public function orWhereNotEquals(string $column, int|float|string $value): static;

    public function orWhereIn(string $column, array $values): static;

    public function orWhereNotIn(string $column, array $values): static;

    public function orWhereIsNull(string $column): static;

    public function orWhereIsNotNull(string $column): static;

    public function orWhereBetween(string $column, int|float $from, int|float $to): static;

    public function orWhereNotBetween(string $column, int|float $from, int|float $to): static;

    public function orWhereLike(string $column, string $pattern): static;

    public function orWhereNotLike(string $column, string $pattern): static;
}
