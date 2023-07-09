<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Tests\Stubs;

final class UserName extends SingleValueObject
{
    public function __construct(
        private string $name,
    ) {
    }

    public function getValue(): mixed
    {
        return $this->name;
    }

    public function getUserName(): string
    {
        return $this->name;
    }

    public function setUserName(string $newName): void
    {
        // validate $newName...

        $this->name = $newName;
    }
}
