<?php

namespace Yuges\Ownable\Models;

use Yuges\Ownable\Config\Config;
use Yuges\Package\Traits\HasTable;
use Yuges\Ownable\Traits\HasOwner;
use Yuges\Ownable\Traits\HasOwnable;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Package\Traits\HasTimestamps;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Ownership extends MorphPivot implements Orderable
{
    use
        HasTable,
        HasOwner,
        HasOrder,
        HasOwnable,
        HasFactory,
        HasTimestamps;

    public $table = 'ownerships';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getOwnershipTable() ?? $this->table;
    }

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where('ownable_id', $this->ownable_id)
            ->where('ownable_type', $this->ownable_type);

        return $options;
    }
}
