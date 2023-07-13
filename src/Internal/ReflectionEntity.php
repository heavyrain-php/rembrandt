<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

use ReflectionClass;
use Rembrandt\Entity;
use Rembrandt\InvalidEntityDefinitionException;
use Rembrandt\PrimaryKey;

/**
 * @psalm-internal \Rembrandt
 * @template TEntity of object
 */
class ReflectionEntity
{
    private readonly string $tableName;
    /** @var string[] $primaryKeys */
    private readonly array $primaryKeys;

    /**
     * @param string $name
     * @psalm-param class-string<TEntity> $name
     */
    public function __construct(
        string $name,
    ) {
        if (!\class_exists($name)) {
            throw new InvalidEntityDefinitionException($name . ' is not a class');
        }
        $ref = new ReflectionClass($name);
        if (!$ref->isInstantiable()) {
            throw new InvalidEntityDefinitionException($name . ' cannot instantiate');
        }
        $entityAttrs = $ref->getAttributes(Entity::class);
        if (\count($entityAttrs) === 0) {
            throw new InvalidEntityDefinitionException($name . ' does not have Entity Attribute');
        }
        $this->tableName = $entityAttrs[0]->newInstance()->table;

        /** @var string[] */
        $pks = [];
        foreach ($ref->getProperties() as $prop) {
            $pk = $prop->getAttributes(PrimaryKey::class);
            if (\count($pk) === 0) {
                continue;
            }
            $pks[] = $pk[0]->getName();
        }
        if (\count($pks) === 0) {
            throw new InvalidEntityDefinitionException($name . ' does not have PrimaryKey property Attribute');
        }
        $this->primaryKeys = $pks;
    }

    /**
     * Retrieves raw table name
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * Retrieves primary key column names
     * @return array
     * @psalm-return string[]
     */
    public function getPrimaryKeys(): array
    {
        return $this->primaryKeys;
    }
}
