<?php

namespace Yuges\Ownable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Ownable\Traits\CanOwn;
use Yuges\Ownable\Interfaces\Owner;

class User extends Model implements Owner
{
    use CanOwn;

    protected $table = 'users';

    protected $guarded = ['id'];
}
