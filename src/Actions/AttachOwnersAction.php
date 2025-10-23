<?php

namespace Yuges\Ownable\Actions;

use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Ownable\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Model;

class AttachOwnersAction
{
    public function __construct(
        protected Ownable $ownable
    ) {
    }

    public static function create(Ownable $ownable): self
    {
        return new static($ownable);
    }

    /**
     * @param null|Collection<array-key, Owner> $owners
     */
    public function execute(?Collection $owners = null): Ownable
    {
        $owners ??= Collection::make([$this->ownable->defaultOwner()]);

        $owners->each(function (Owner $owner) {
            $relation = $this->ownable->ownerships();

            $relation->getQuery()->withAttributes($this->pivotValues($owner));

            $relation->create();
        });

        return $this->ownable;
    }

    public function pivotValues(?Owner $owner = null): array
    {
        $pivot = new Ownership();
        $relation = $pivot->owner();

        return [
            $relation->getForeignKeyName() => $owner instanceof Model ? $owner->getKey() : null,
            $relation->getMorphType() => $owner instanceof Model ? $owner->getMorphClass() : null,
        ];
    }
}
