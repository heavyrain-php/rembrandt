<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Laravel;

use Rembrandt\BuilderInterface;
use Rembrandt\BuildResult;
use Illuminate\Support\LazyCollection;

/**
 * @template TEntity of object
 * @implements BuilderInterface<TEntity, LazyCollection>
 */
class Builder implements BuilderInterface
{
    public function __construct(

    ) {
    }

    public function find(int|string|array $pks): object
    {

    }

    public function findOrNull(int|string|array $pks): ?object
    {

    }

    public function findAll(): BuildResult
    {

    }
}
