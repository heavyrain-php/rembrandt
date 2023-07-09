<?php

declare(strict_types=1);

/**
 * @license MIT
 */

namespace Airily\Laravel;

use Airily\AirilyInterface;
use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return AirilyInterface::class;
    }
}
