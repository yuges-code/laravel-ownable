<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Illuminate\Support\Collection;
use Yuges\Ownable\Interfaces\Owner;
use Illuminate\Support\Facades\Auth;

trait HasOwners
{
    use HasOwnerships;

    /** @return Collection<array-key, class-string<Owner>> */
    public function getOwners(): Collection
    {
        $relation = Config::getOwnerRelationName('owner');

        return $this->ownerships()->getQuery()->with($relation)->get()->pluck($relation);
    }

    public function defaultOwner(): ?Owner
    {
        /** @var ?Owner */
        $owner = Auth::user();

        return $owner;
    }
}
