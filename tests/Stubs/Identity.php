<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Tests\Stubs;

use JsonSerializable;

/**
 * Identity of this entity
 * @template T of object
 */
final class Identity implements JsonSerializable
{
    public function __construct(public readonly int $id)
    {
    }

    public function jsonSerialize(): mixed
    {
        return $this->id;
    }
}
