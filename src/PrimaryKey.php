<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily;

use Attribute;

/**
 * Relational database primary key attribute
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final class PrimaryKey
{
}
