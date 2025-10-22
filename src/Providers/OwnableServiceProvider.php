<?php

namespace Yuges\Ownable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Ownable\Config\Config;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Exceptions\InvalidOwnership;
use Yuges\Ownable\Observers\OwnershipObserver;

class OwnableServiceProvider extends \Yuges\Package\Providers\PackageServiceProvider
{
    protected string $name = 'laravel-ownable';

    public function configure(Package $package): void
    {
        $ownership = Config::getOwnershipClass(Ownership::class);

        if (! is_a($ownership, Ownership::class, true)) {
            throw InvalidOwnership::doesNotImplementOwnership($ownership);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('ownable')
            ->hasMigrations([
                'create_ownerships_table',
            ])
            ->hasObserver($ownership, Config::getOwnershipObserverClass(OwnershipObserver::class));
    }
}
