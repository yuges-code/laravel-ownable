<?php

namespace Yuges\Ownable\Actions;

use Illuminate\Support\Collection;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Ownable\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Model;

class DetachOwnersAction
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
        if (! $owners) {
            $this->ownable->ownerships()->delete();

            return $this->ownable;
        }

        $owners->each(function (Owner $owner) {
            $relation = $this->ownable->ownerships();

            $relation->getQuery()->withAttributes($this->pivotValues($owner));

            $relation->delete();
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
