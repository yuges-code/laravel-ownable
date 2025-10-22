<?php

namespace Yuges\Ownable\Traits;

use Yuges\Ownable\Config\Config;
use Yuges\Ownable\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?string $ownable_type
 * @property null|int|string $ownable_id
 * 
 * @property ?Ownable $ownable
 */
trait HasOwnable
{
    public function ownable(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getOwnableRelationName('ownable'));
    }
}
