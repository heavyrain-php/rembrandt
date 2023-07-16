<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Rembrandt\Internal;

/**
 * @psalm-internal \Rembrandt
 */
interface QueryJoinInterface
{
    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function innerJoin(string $joinTable, string $myKey, string $relationKey): static;

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function leftOuterJoin(string $joinTable, string $myKey, string $relationKey): static;

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function rightOuterJoin(string $joinTable, string $myKey, string $relationKey): static;

    /**
     * @param string $joinTable
     * @param string $myKey
     * @param string $relationKey
     * @return static
     */
    public function fullOuterJoin(string $joinTable, string $myKey, string $relationKey): static;
}
