<?php

namespace Yuges\Ownable\Interfaces;

use Illuminate\Support\Collection;
use Yuges\Ownable\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Owner
{
    public function ownerships(): HasMany;

    public function getOwnables(): Collection;

    public function morphedByManyOwnable(string $related): MorphToMany;
}
