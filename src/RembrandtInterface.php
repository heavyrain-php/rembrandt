<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

/**
 * @template TCollection of object
 */
interface RembrandtInterface
{
    /**
     * Creates builder for specified Mapping
     * @template TEntity of object
     * @param string $entityName
     * @psalm-param class-string<TEntity> $entityName
     * @return QueryBuilderInterface
     * @psalm-return BuilderInterface<TEntity, TCollection>
     */
    public function of(string $entityName): QueryBuilderInterface;
}
