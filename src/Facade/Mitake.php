<?php

namespace Mitake\Laravel\Facade;

use Illuminate\Support\Facades\Facade;
use Mitake\Client;

class Mitake extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
