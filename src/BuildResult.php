<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

/**
 * @template TCollection of object
 */
final class BuildResult
{
    /**
     * @param iterable $results
     * @psalm-param iterable<array-key, mixed> $results
     * @param CollectionFactoryInterface $collectionFactory
     * @psalm-param CollectionFactoryInterface<TCollection> $collectionFactory
     */
    public function __construct(
        private readonly iterable $results,
        private readonly CollectionFactoryInterface $collectionFactory,
    ) {
    }

    public function toRawResult(): iterable
    {
        return $this->results;
    }

    /**
     * @return object
     * @psalm-return TCollection
     */
    public function toCollection(): object
    {
        return $this->collectionFactory->factory($this->results);
    }

    public function toArray(): array
    {
    }
}
