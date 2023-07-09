<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

/**
 * @template T of object
 */
interface MappingInterface
{
    /**
     * Retrieves target entity class name
     * @return string
     * @psalm-return class-string<T>
     */
    public function getEntityName(): string;

    /**
     * Retrieves table name
     * @return string
     */
    public function getTableName(): string;
}
