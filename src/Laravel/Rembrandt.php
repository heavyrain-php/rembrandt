<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Laravel;

use Rembrandt\RembrandtInterface;

use Illuminate\Support\LazyCollection;
use Rembrandt\QueryBuilderInterface;

/**
 * @implements RembrandtInterface<LazyCollection>
 */
final class Rembrandt implements RembrandtInterface
{
    public function of(string $entityName): QueryBuilderInterface
    {

    }
}
