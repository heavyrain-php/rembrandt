<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\PDO;

use PDO;
use Rembrandt\QueryBuilderInterface;
use Rembrandt\Internal\ReflectionEntity;
use Rembrandt\RembrandtInterface;

/**
 * @implements RembrandtInterface<\Generator>
 */
final class Rembrandt implements RembrandtInterface
{
    public function __construct(
        private readonly PDO $pdo,
    ) {
    }

    /**
     * Creates builder for specified Mapping
     * @template TEntity of object
     * @param string $entityName
     * @psalm-param class-string<TEntity> $entityName
     * @return QueryBuilderInterface
     * @psalm-return QueryBuilderInterface<TEntity, \Generator>
     */
    public function of(string $entityName): QueryBuilderInterface
    {
        return new PDOBuilder(new ReflectionEntity($entityName), $this->pdo);
    }
}
