<?php

namespace Yuges\Ownable\Actions;

use Illuminate\Support\Collection;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Ownable\Interfaces\Ownable;

class SyncOwnersAction
{
    public function __construct(
        protected Ownable $ownable
    ) {
    }

    public static function create(Ownable $ownable): self
    {
        return new static($ownable);
    }

    /**
     * @param Collection<array-key, Owner> $owners
     */
    public function execute(Collection $owners): Ownable
    {
        $this->ownable
            ->detachOwners()
            ->attachOwners($owners);

        return $this->ownable;
    }
}
