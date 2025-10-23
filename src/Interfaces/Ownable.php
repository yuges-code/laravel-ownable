<?php

namespace Yuges\Ownable\Interfaces;

use Illuminate\Support\Collection;
use Yuges\Ownable\Options\OwnableOptions;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Ownable
{
    public function ownable(): OwnableOptions;

    public function ownerships(): HasMany;

    public function getOwners(): Collection;

    public function own(?Owner $owner = null): static;

    public function unown(Owner $owner): static;

    public function attachOwner(?Owner $owner = null): static;

    public function attachOwners(?Collection $owners = null): static;

    public function detachOwner(Owner $owner): static;

    public function detachOwners(?Collection $owners = null): static;

    public function syncOwners(Collection $owners): static;

    public function defaultOwner(): ?Owner;
}
