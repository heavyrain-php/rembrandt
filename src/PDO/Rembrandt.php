<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\PDO;

use PDO;
use Rembrandt\BuilderInterface;
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
     * @return BuilderInterface
     * @psalm-return BuilderInterface<TEntity, \Generator>
     */
    public function of(string $entityName): BuilderInterface
    {
        return new PDOBuilder($entityName, $this->pdo);
    }
}
