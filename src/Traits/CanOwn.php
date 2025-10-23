<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Illuminate\Support\Collection;
use Yuges\Ownable\Interfaces\Ownable;
use Yuges\Ownable\Observers\OwnerObserver;

trait CanOwn
{
    use HasOwnerships;

    protected static function bootCanOwn(): void
    {
        static::observe(Config::getOwnerObserverClass(OwnerObserver::class));
    }

    /** @return Collection<array-key, class-string<Ownable>> */
    public function getOwnables(): Collection
    {
        $relation = Config::getOwnableRelationName('ownable');

        return $this->ownerships()->getQuery()->with($relation)->get()->pluck($relation);
    }
}
