<?php

namespace Yuges\Ownable\Tests;

use Illuminate\Contracts\Config\Repository;
use Orchestra\Testbench\Attributes\WithMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Yuges\Ownable\Providers\OwnableServiceProvider;

#[WithMigration]
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        # code...

        parent::setUp();
    }

    protected function defineEnvironment($app)
    {
        tap($app['config'], function (Repository $config) {
            $config->set('ownable', require __DIR__ . '/../../config/ownable.php');
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            OwnableServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom([
                __DIR__ . '/../../database/migrations/',
                __DIR__ . '/Stubs/Migrations',
            ]
        );
    }
}
