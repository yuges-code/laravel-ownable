<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Yuges\Ownable\Options\OwnableOptions;
use Yuges\Ownable\Observers\OwnableObserver;
use Illuminate\Database\Eloquent\Relations\Relation;

trait HasOwners
{
    use HasOwnerships;

    protected ?Relation $createdByRelation = null;

    public function ownable(): OwnableOptions
    {
        return new OwnableOptions;
    }

    protected static function bootHasOwners(): void
    {
        static::observe(Config::getOwnableObserverClass(OwnableObserver::class));
    }

    /** @return Collection<array-key, class-string<Owner>> */
    public function getOwners(): Collection
    {
        $relation = Config::getOwnerRelationName('owner');

        return $this->ownerships()->getQuery()->with($relation)->get()->pluck($relation);
    }

    public function own(?Owner $owner = null): static
    {
        return $this->attachOwner($owner);
    }

    public function unown(Owner $owner): static
    {
        return $this->detachOwner($owner);
    }

    public function isOwn(?Owner $owner = null): bool
    {
        $pivot = new Ownership();
        $relation = $pivot->owner();
        $owner ??= $this->defaultOwner();

        $attributes = [
            $relation->getForeignKeyName() => $owner instanceof Model ? $owner->getKey() : null,
            $relation->getMorphType() => $owner instanceof Model ? $owner->getMorphClass() : null,
        ];

        $relation = $this->ownerships();

        $relation->getQuery()->withAttributes($attributes);

        return $relation->getBaseQuery()->exists();
    }

    public function attachOwner(?Owner $owner = null): static
    {
        $this->attachOwners($owner ? Collection::make([$owner]) : null);

        return $this;
    }

    /**
     * @param Collection<array-key, Owner> $owners
     */
    public function attachOwners(?Collection $owners = null): static
    {
        Config::getAttachOwnersAction($this)->execute($owners);

        return $this;
    }

    public function detachOwner(Owner $owner): static
    {
        $this->detachOwners(Collection::make([$owner]));

        return $this;
    }

    /**
     * @param null|Collection<array-key, Owner> $owners
     */
    public function detachOwners(?Collection $owners = null): static
    {
        Config::getDetachOwnersAction($this)->execute($owners);

        return $this;
    }

    /**
     * @param Collection<array-key, Owner> $owners
     */
    public function syncOwners(Collection $owners): static
    {
        Config::getSyncOwnersAction($this)->execute($owners);

        return $this;
    }

    public function defaultOwner(): ?Owner
    {
        /** @var ?Owner */
        $owner = Auth::user();

        return $owner;
    }

    public function getCreatingRelation(): ?Relation
    {
        return $this->createdByRelation;
    }

    public function setCreatingRelation(?Relation $relation = null): self
    {
        $this->createdByRelation = $relation;

        return $this;
    }
}
