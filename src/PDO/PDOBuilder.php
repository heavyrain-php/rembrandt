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
use Rembrandt\Internal\GroupByQueryBuilderTrait;
use Rembrandt\Internal\JoinQueryBuilderTrait;
use Rembrandt\Internal\OrderByQueryBuilderTrait;
use Rembrandt\Internal\ReflectionEntity;
use Rembrandt\Internal\SelectQueryBuilderTrait;
use Rembrandt\Internal\WhereQueryBuilderTrait;

/**
 * @template TEntity of object
 * @implements QueryBuilderInterface<TEntity, \Generator>
 */
class PDOBuilder implements QueryBuilderInterface
{
    use GroupByQueryBuilderTrait;
    use JoinQueryBuilderTrait;
    use OrderByQueryBuilderTrait;
    use SelectQueryBuilderTrait;
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

    private function getBaseTableName(): string {
        return $this->refEntity->getTableName();
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
                'PRIMARY KEY count is invalid count. defined=%d param=%d',
                \count($pkArray),
                \count($this->refEntity->getPrimaryKeys()),
            ));
        }
        foreach ($this->refEntity->getPrimaryKeys() as $index => $pk) {
            /** @psalm-suppress MixedArrayTypeCoercion */
            $this->whereEquals($pk, $pkArray[$index]);
        }
        $where = $this->buildWhere();
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
        $result = $this->firstOrNull();

        if (\is_null($result)) {
            throw new EntityNotFoundException();
        }

        return $result;
    }

    public function firstOrNull(): ?object
    {
        $sqlBindings = $this->buildRawSqlAndBindings();

        $stmt = $this->pdo->prepare($sqlBindings['sql']);
        $stmt->execute($sqlBindings['bindings']);

        /** @var array<array-key, mixed>|false */
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result === false) {
            return null;
        }

        // TODO: mapping
        return $result;
    }

    public function get(): BuildResult
    {
        $sqlBindings = $this->buildRawSqlAndBindings();

        $stmt = $this->pdo->prepare($sqlBindings['sql']);
        $stmt->execute($sqlBindings['bindings']);

        // TODO
        return new BuildResult($stmt, null);
    }

    public function executeRawQuery(string $sql, array $bindings): iterable
    {
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($bindings);

        return $stmt;
    }

    public function union(QueryBuilderInterface|array $builder): BuildResult
    {
        $builders = \is_array($builder) ? $builder : [$builder];

        $sqlList = [];
        $bindingsList = [];
        foreach ($builders as $b) {
            $sqlBindings = $b->buildRawSqlAndBindings();
            $sqlList[] = $sqlBindings['sql'];
            $bindingsList = \array_merge($bindingsList, $sqlBindings['bindings']);
        }

        $stmt = $this->pdo->prepare(\implode(' UNION ', $sqlList));
        $stmt->execute($bindingsList);

        // TODO
        return new BuildResult($stmt, null);
    }

    public function buildRawSqlAndBindings(): array
    {
        $select = $this->buildSelect();
        $from = $this->buildFrom();
        $join = $this->buildJoin();
        $where = $this->buildWhere();
        $groupBy = $this->buildGroupBy();
        $orderBy = $this->buildOrderBy();

        $sql = \implode(' ', [
            $select,
            $from,
            $join,
            $where['sql'],
            $groupBy,
            $orderBy,
        ]);

        $bindings = $where['bindings'];

        return compact('sql', 'bindings');
    }

    private function buildFrom(): string
    {
        return \sprintf('FROM %s', $this->getBaseTableName());
    }
}
