# Airily

Airily - Framework-agnostic Data Mapper ORM

## Prerequisites

- PHP 8.1+

## Installation

```sh
$ composer require heavyrain/airily
```

## Usage

### Laravel

```php
<?php
// app/Http/Controllers/IndexController.php
namespace App\Http\Controllers;

use Airily\Laravel\Facade as A;

class IndexController extends Controller
{
    public function getUser(int $userId): \JsonSerializable
    {
        return A::of(UserEntity::class)->find($userId);
    }
}

// app/Domain/User.php
namespace App\Domain;

#[\Airily\Entity('users')]
class UserEntity implements \JsonSerializable
{
    public function __construct(
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
