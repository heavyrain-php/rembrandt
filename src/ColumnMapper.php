<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class ColumnMapper
{
    public function __construct(
        public readonly string $mapperClassName,
    ) {
    }
}
