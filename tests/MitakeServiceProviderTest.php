<?php

namespace Mitake\Laravel\Tests;

use Mitake\Client;

class MitakeServiceProviderTest extends AbstractTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('mitake.username', 'username');
        $app['config']->set('mitake.password', 'password');
    }

    public function testCreateMitakeService()
    {
        $actual = app(Client::class);

        $this->assertInstanceOf(Client::class, $actual);
    }

    public function testClientCreatedWithUsernameAndPassword()
    {
        $client = app(Client::class);
        $actualUsername = $this->getClassProperty(Client::class, 'username', $client);
        $actualPassword = $this->getClassProperty(Client::class, 'password', $client);

        $this->assertEquals('username', $actualUsername);
        $this->assertEquals('password', $actualPassword);
    }
}
