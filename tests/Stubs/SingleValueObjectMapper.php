<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Tests\Stubs;

use Rembrandt\ObjectMapperInterface;

/**
 * @template T of SingleValueObject
 * @implements ObjectMapperInterface<T>
 */
final class SingleValueObjectMapper implements ObjectMapperInterface
{
    /**
     * @param string $objectName
     * @psalm-param class-string<T> $objectName
     */
    public function __construct(
        private readonly string $objectName,
    ) {
    }

    public function fromColumnToObject(mixed $value): object
    {
        /** @psalm-suppress UnsafeInstantiation */
        return new ($this->objectName)($value);
    }

    public function fromObjectToColumn(object $obj): mixed
    {
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        \assert($obj instanceof SingleValueObject, 'obj must extends SingleValueObject');
        return $obj->getValue();
    }
}
