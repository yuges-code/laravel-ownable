<?php

namespace Yuges\Ownable\Observers;

use Yuges\Ownable\Interfaces\Ownable;
use Illuminate\Database\Eloquent\Model;

class OwnableObserver
{
    public function created(Ownable $ownable): void
    {
        $options = $ownable->ownable();

        if ($options->auto) {
            $ownable->attachOwner();
        }
    }

    public function deleted(Ownable $ownable): void
    {
        if (! $ownable instanceof Model) {
            return;
        }

        if (method_exists($ownable, 'isForceDeleting') && ! $ownable->isForceDeleting()) {
            return;
        }

        $ownable->detachOwners();
    }
}
