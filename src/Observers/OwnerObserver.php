<?php

namespace Yuges\Ownable\Observers;

use Yuges\Ownable\Interfaces\Owner;
use Illuminate\Database\Eloquent\Model;

class OwnerObserver
{
    public function deleted(Owner $owner): void
    {
        if (! $owner instanceof Model) {
            return;
        }

        if (method_exists($owner, 'isForceDeleting') && ! $owner->isForceDeleting()) {
            return;
        }

        $owner->ownerships()->delete();
    }
}
