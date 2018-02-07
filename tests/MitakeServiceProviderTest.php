<?php

namespace Mitake\Laravel\Tests;

use Illuminate\Support\ServiceProvider;
use Mitake\Laravel\MitakeServiceProvider;
use PHPUnit\Framework\TestCase;

class MitakeServiceProviderTest extends TestCase
{
    public function testCreateMitakeServiceProvider()
    {
        $actual = new MitakeServiceProvider(app());

        $this->assertInstanceOf(ServiceProvider::class, $actual);
    }
}
