<?php

namespace Yuges\Ownable\Tests\Feature;

use Yuges\Ownable\Tests\TestCase;
use Yuges\Ownable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
