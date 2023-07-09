<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily;

interface AirilyInterface
{
    /**
     * Creates builder for specified Mapping
     * @template T of object
     * @param string $entityName
     * @psalm-param class-string<T> $entityName
     * @return BuilderInterface
     * @psalm-return BuilderInterface<T>
     */
    public function of(string $entityName): BuilderInterface;
}
