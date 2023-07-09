<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily\Tests\Stubs;

use Airily\Entity;
use Airily\PrimaryKey;
use JsonSerializable;

#[Entity('user_equipments')]
final class UserEquipmentEntity implements JsonSerializable
{
    /**
     * @param Identity<UserEquipmentEntity> $id
     * @param Identity<UserEntity> $userId
     * @param Identity<EquipmentEntity> $equipmentId
     */
    public function __construct(
        #[PrimaryKey]
        public readonly Identity $id,
        public readonly Identity $userId,
        public readonly Identity $equipmentId,
    ) {
    }

    public function user(): mixed
    {
        // TODO
        return null;
    }

    public function equipment(): mixed
    {
        // TODO
        return null;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'equipmentId' => $this->equipmentId,
        ];
    }
}
