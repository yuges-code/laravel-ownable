<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Ownable\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection<array-key, Ownership> $ownerships
 */
trait HasOwnerships
{
    public function ownerships(): HasMany
    {
        $name = match (true) {
            $this instanceof Owner => Config::getOwnerRelationName('owner'),
            $this instanceof Ownable => Config::getOwnableRelationName('ownable'),
        };

        /** @var Model $this */
        $relation = $this->hasMany(Config::getOwnershipClass(Ownership::class), "{$name}_id");

        $relation->getQuery()->where("{$name}_type", $this->getMorphClass());

        return $relation;
    }
}
