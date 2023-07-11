<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

/**
 * Converts iterable items to Collection instance
 * @template T of object
 */
interface CollectionFactoryInterface
{
    /**
     * Creates collection
     * @param iterable $items
     * @psalm-param iterable<array-key, mixed> $items
     * @return object
     * @psalm-return T
     */
    public function factory(iterable $items): object;
}
