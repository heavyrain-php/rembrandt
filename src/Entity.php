<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class Entity
{
    public function __construct(
        public readonly string $table,
    ) {
        \assert(strlen($this->table) > 0, '$table cannot be empty');
    }
}
