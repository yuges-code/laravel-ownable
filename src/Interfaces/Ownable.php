<?php

namespace Yuges\Ownable\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Ownable
{
    public function ownerships(): HasMany;

    public function defaultOwner(): ?Owner;

    public function getOwners(): Collection;
}
