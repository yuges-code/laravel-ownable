<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Ownable;
use Yuges\Ownable\Relations\MorphToMany;
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

    /**
     * Define a polymorphic, inverse many-to-many relationship.
     *
     * @template TRelatedModel of \Illuminate\Database\Eloquent\Model
     *
     * @param  class-string<TRelatedModel>  $related
     * @return MorphToMany<TRelatedModel, $this>
     */
    public function morphedByManyOwnable(string $related): MorphToMany
    {
        $owner = Config::getOwnerRelationName('owner');
        $ownable = Config::getOwnableRelationName('ownable');

        $relation = $this->guessBelongsToManyRelation();
        $instance = $this->newRelatedInstance($related);

        return new MorphToMany(
            $instance->newQuery(),
            $this,
            $ownable,
            Config::getOwnershipClass(Ownership::class)::getTableName(),
            "{$owner}_id",
            "{$ownable}_id",
            $this->getKeyName(),
            $instance->getKeyName(),
            $relation,
            true,
        )
        ->using(Config::getOwnershipClass(Ownership::class))
        ->withPivotValue("{$owner}_type", $this->getMorphClass());
    }
}
