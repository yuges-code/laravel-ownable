<?php

namespace Yuges\Ownable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Ownable\Traits\HasOwners;
use Yuges\Ownable\Interfaces\Ownable;

class Post extends Model implements Ownable
{
    use HasOwners;

    protected $table = 'posts';

    protected $guarded = ['id'];
}
