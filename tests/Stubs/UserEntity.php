<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily\Tests\Stubs;

use Airily\ColumnMapper;
use Airily\Entity;
use Airily\PrimaryKey;
use JsonSerializable;

#[Entity('users')]
final class UserEntity implements JsonSerializable
{
    /**
     * @param Identity<UserEntity> $id
     * @param UserName $name
     * @param string $email
     */
    public function __construct(
        #[PrimaryKey]
        public readonly Identity $id,
        #[ColumnMapper(SingleValueObjectMapper::class)]
        private UserName $name,
        private string $email,
    ) {
    }

    /**
     * @return array
     * @psalm-return UserEquipmentEntity[]
     */
    public function equipments(): array
    {
        // TODO
        return [];
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
