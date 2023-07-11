<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\PDO;

use Generator;
use Rembrandt\CollectionFactoryInterface;

/**
 * @implements CollectionFactoryInterface<Generator>
 */
final class GeneratorFactory implements CollectionFactoryInterface
{
    public function factory(iterable $items): Generator
    {
        /** @var mixed $value */
        foreach ($items as $key => $value) {
            yield $key => $value;
        }
    }
}
