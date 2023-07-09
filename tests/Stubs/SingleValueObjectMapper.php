<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily\Tests\Stubs;

use Airily\ObjectMapperInterface;

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
        return new ($this->objectName)($value);
    }

    public function fromObjectToColumn(object $obj): mixed
    {
        \assert($obj instanceof SingleValueObject, 'obj must extends SingleValueObject');
        return $obj->getValue();
    }
}