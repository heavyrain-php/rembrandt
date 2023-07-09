<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily\Tests\Stubs;

use Airily\Entity;
use Airily\PrimaryKey;
use JsonSerializable;

#[Entity('equipments')]
final class EquipmentEntity implements JsonSerializable
{
    /**
     * @param Identity<EquipmentEntity> $id
     * @param string $name
     * @param float $attack
     */
    public function __construct(
        #[PrimaryKey]
        public readonly Identity $id,
        public readonly string $name,
        public readonly float $attack,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'attack' => $this->attack,
        ];
    }
}
