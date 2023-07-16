<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

use Rembrandt\Internal\QueryGroupByInterface;
use Rembrandt\Internal\QueryJoinInterface;
use Rembrandt\Internal\QueryOrderByInterface;
use Rembrandt\Internal\QuerySelectInterface;
use Rembrandt\Internal\QueryWhereInterface;

/**
 * @template TEntity of object
 * @template TCollection of object
 */
interface QueryBuilderInterface extends
    QueryGroupByInterface,
    QueryJoinInterface,
    QueryOrderByInterface,
    QuerySelectInterface,
    QueryWhereInterface
{
    /**
     * Finds by primary keys
     * @param int|string|array $pks
     * @psalm-param int|string|list<int|string> $pks
     * @return object
     * @psalm-return TEntity
     * @throws EntityNotFoundException
     */
    public function find(int|string|array $pks): object;

    /**
     * Finds by primary keys and return null if not found
     * @param int|string|array $pks
     * @psalm-param int|string|list<int|string> $pks
     * @return object|null
     * @psalm-return TEntity|null
     */
    public function findOrNull(int|string|array $pks): ?object;

    /**
     * Finds all items
     * @return BuildResult
     * @psalm-return BuildResult<TCollection>
     */
    public function findAll(): BuildResult;

    /**
     * Finds first item
     * @return object
     * @psalm-return TEntity
     * @throws EntityNotFoundException
     */
    public function first(): object;

    /**
     * Finds first item and return null if not found
     * @return object|null
     * @psalm-return TEntity|null
     */
    public function firstOrNull(): ?object;

    /**
     * Finds all items by query
     * @return BuildResult
     * @psalm-return BuildResult<TCollection>
     */
    public function get(): BuildResult;

    /**
     * Executes raw query and returns raw \stdClass iterable(lazily)
     * @param string $sql
     * @param array $bindings
     * @psalm-param array<int, int|float|string> $bindings
     * @return iterable
     * @psalm-return iterable<int, \stdClass>
     */
    public function executeRawQuery(string $sql, array $bindings): iterable;

    /**
     * Executes UNION with multiple builders
     * @param QueryBuilderInterface|array $builder
     * @psalm-param QueryBuilderInterface|QueryBuilderInterface[] $builder
     * @return BuildResult
     */
    public function union(QueryBuilderInterface|array $builder): BuildResult;

    /**
     * @return array{sql: string, bindings: list<int|float|string>}
     */
    public function buildRawSqlAndBindings(): array
}
