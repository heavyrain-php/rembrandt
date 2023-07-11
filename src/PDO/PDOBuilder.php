<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\PDO;

use PDO;
use Rembrandt\BuilderInterface;
use Rembrandt\BuildResult;
use Rembrandt\EntityNotFoundException;
use Rembrandt\Internal\ReflectionEntity;
use Rembrandt\InvalidEntityDefinitionException;

/**
 * @template TEntity of object
 * @implements BuilderInterface<TEntity, \Generator>
 */
class PDOBuilder implements BuilderInterface
{
    private readonly ReflectionEntity $refEntity;

    /**
     * @param string $entityName
     * @psalm-param class-string<TEntity> $entityName
     * @param PDO $pdo
     */
    public function __construct(
        private readonly string $entityName,
        private readonly PDO $pdo,
    ) {
        $this->refEntity = new ReflectionEntity($this->entityName);
    }

    public function find(int|string|array $pks): object
    {
        $result = $this->findOrNull($pks);

        if (\is_null($result)) {
            throw new EntityNotFoundException();
        }

        return $result;
    }

    public function findOrNull(int|string|array $pks): ?object
    {
        $pkArray = \is_array($pks) ? $pks : [$pks];
        $stmt = $this->pdo->prepare(\sprintf(
            'SELECT * FROM `%s` WHERE %s',
            $this->refEntity->getTableName(),
            $this->buildWhere($pkArray),
        ));
        foreach ($pkArray as $index => $pk) {
            $stmt->bindvalue($index + 1, $pk, \is_int($pk) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
        }

        $stmt->execute();
        /** @var array<array-key, mixed>|false */
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            return null;
        }

        // TODO: mapping
        return $result;
    }

    public function findAll(): BuildResult
    {
        // TODO
    }

    private function buildWhere(array $pks): string
    {
        // TODO: Move it to driver-specific query builder
        $pkNames = $this->refEntity->getPrimaryKeys();

        if (\count($pkNames) !== \count($pks)) {
            throw new InvalidEntityDefinitionException(\sprintf('Invalid PrimaryKey count expected=%d actual=%d', \count($pkNames), \count($pks)));
        }

        $wheres = [];
        foreach ($pkNames as $column) {
            $wheres[] = \sprintf('`%s` = ?', $column);
        }

        return \implode(' AND ', $wheres);
    }
}
