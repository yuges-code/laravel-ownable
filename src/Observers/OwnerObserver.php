<?php

namespace Yuges\Ownable\Observers;

use Yuges\Groupable\Models\Group;

class OwnerObserver
{
    public function creating(Group $group): void
    {

    }

    public function saving(Group $group): void
    {

    }

    public function deleted(Group $group): void
    {

    }
}
