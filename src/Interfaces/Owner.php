<?php

namespace Yuges\Ownable\Interfaces;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface Owner
{
    public function ownerships(): HasMany;

    public function getOwnables(): Collection;
}
