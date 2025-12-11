<?php

namespace Yuges\Ownable\Tests\Stubs\Models;

use Yuges\Ownable\Traits\CanOwn;
use Yuges\Package\Traits\HasKey;
use Yuges\Package\Traits\HasTable;
use Yuges\Ownable\Interfaces\Owner;
use Yuges\Package\Traits\HasTimestamps;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class User extends Authenticatable implements Owner
{
    use
        CanOwn,
        HasKey,
        HasTable,
        HasTimestamps;

    protected $table = 'users';

    protected $guarded = ['id'];

    public function posts(): MorphToMany
    {
        return $this->morphedByManyOwnable(Post::class);
    }
}
