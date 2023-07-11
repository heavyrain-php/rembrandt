<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Tests\Stubs;

final class UserName extends SingleValueObject
{
    public function __construct(
        public readonly string $name,
    ) {
    }

    public function getValue(): mixed
    {
        return $this->name;
    }

    public function withNewUserName(string $newName): self
    {
        // validate $newName...

        return new self($newName);
    }
}
