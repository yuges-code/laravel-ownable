<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Yuges\Ownable\Interfaces\Owner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?string $owner_type
 * @property null|int|string $owner_id
 * 
 * @property ?Owner $owner
 */
trait HasOwner
{
    public function owner(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getOwnerRelationName('owner'));
    }
}
