<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Tests\Stubs;

use JsonSerializable;

abstract class SingleValueObject implements JsonSerializable
{
    public abstract function getValue(): mixed;

    public function jsonSerialize(): mixed
    {
        return $this->getValue();
    }
}
