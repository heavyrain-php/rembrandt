<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Laravel;

use Illuminate\Support\LazyCollection;
use Rembrandt\CollectionFactoryInterface;

/**
 * @implements CollectionFactoryInterface<LazyCollection>
 */
final class LazyCollectionFactory implements CollectionFactoryInterface
{
    public function factory(iterable $items): object
    {
        return new LazyCollection($items);
    }
}
