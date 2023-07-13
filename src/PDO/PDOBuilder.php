<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\PDO;

use InvalidArgumentException;
use PDO;
use Rembrandt\QueryBuilderInterface;
use Rembrandt\BuildResult;
use Rembrandt\EntityNotFoundException;
use Rembrandt\Internal\ReflectionEntity;
use Rembrandt\Internal\WhereQueryBuilderTrait;

/**
 * @template TEntity of object
 * @implements QueryBuilderInterface<TEntity, \Generator>
 */
class PDOBuilder implements QueryBuilderInterface
{
    use WhereQueryBuilderTrait;

    /**
     * @param ReflectionEntity<TEntity> $refEntity
     * @param PDO $pdo
     */
    public function __construct(
        private readonly ReflectionEntity $refEntity,
        private readonly PDO $pdo,
    ) {
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
        /** @var list<int|string> */
        $pkArray = \is_array($pks) ? $pks : [$pks];
        if (\count($pkArray) !== \count($this->refEntity->getPrimaryKeys())) {
            throw new InvalidArgumentException(\sprintf(
                'PRIMARY KEY count is invalid. defined=%d param=%d',
                \count($pkArray),
                \count($this->refEntity->getPrimaryKeys()),
            ));
        }
        foreach ($this->refEntity->getPrimaryKeys() as $index => $pk) {
            /** @psalm-suppress MixedArrayTypeCoercion */
            $this->whereEquals($pk, $pkArray[$index]);
        }
        $where = $this->buildWhereQuery();
        $stmt = $this->pdo->prepare(\sprintf(
            'SELECT * FROM `%s` WHERE %s',
            $this->refEntity->getTableName(),
            $where['sql'],
        ));

        $stmt->execute($where['bindings']);
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
        $stmt = $this->pdo->prepare(\sprintf(
            'SELECT * FROM `%s`',
            $this->refEntity->getTableName(),
        ));

        $stmt->execute();
        // TODO
        return new BuildResult($stmt, null);
    }

    public function first(): object
    {

    }

    public function firstOrNull(): ?object
    {

    }

    public function get(): BuildResult
    {

    }

    public function executeRawQuery(string $sql, array $bindings): iterable
    {
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($bindings);

        return $stmt;
    }

    public function select(array $columns): static
    {
        return $this;
    }

    public function selectRaw(array $columns): static
    {
        return $this;
    }

    public function groupByDesc(string|array $columns): static
    {

        return $this;
    }

    public function groupByAsc(string|array $columns): static
    {

        return $this;
    }

    public function groupBy(array $columns): static
    {

        return $this;
    }

    public function orderBy(string|array $columns): static
    {

        return $this;
    }
}
