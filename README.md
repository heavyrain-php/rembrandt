# Rembrandt

Rembrandt - Framework-agnostic Data Mapper ORM

## Prerequisites

- PHP 8.1+

## Installation

```sh
$ composer require heavyrain/rembrandt
```

## Usage

Implements entity

```php
<?php
// app/Domain/User.php
namespace App\Domain;

#[\Rembrandt\Entity(table: 'users')]
class UserEntity implements \JsonSerializable
{
    public function __construct(
        #[\Rembrandt\PrimaryKey]
        public readonly int $id,
        private string $name,
        private string $email,
    ) {
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    // ...
}
```

### PDO

```php
<?php

$pdo = new PDO(/* ... */);

$userId = 1;
$r = new Rembrandt\PDO\Rembrandt($pdo);
$userEntity = $r->of(App\Domain\UserEntity::class)->find($userId);
```

### Laravel

```php
<?php
// app/Http/Controllers/IndexController.php
namespace App\Http\Controllers;

use Rembrandt\Laravel\Facade as R;

class IndexController extends Controller
{
    // using facade
    public function getUser(int $userId): \JsonSerializable
    {
        return R::of(UserEntity::class)->find($userId);
    }

    // or using injection
    public function getUserAll(\Rembrandt\RembrandtInterface $r): \JsonSerializable
    {
        return $r->of(UserEntity::class)->findAll();
    }
}

```
