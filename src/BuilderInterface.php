<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

/**
 * @template TEntity of object
 * @template TCollection of object
 */
interface BuilderInterface
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
}
