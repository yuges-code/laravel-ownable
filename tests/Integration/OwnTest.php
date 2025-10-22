<?php

namespace Yuges\Ownable\Tests\Integration;

use Yuges\Ownable\Tests\TestCase;
use Yuges\Ownable\Models\Ownership;
use Yuges\Ownable\Tests\Stubs\Models\User;
use Yuges\Ownable\Tests\Stubs\Models\Post;

class OwnTest extends TestCase
{
    public function testOwnPosts()
    {
        $user = User::query()->create([
            'name' => 'Georgy',
            'email' => 'goshasafonov@yandex.ru',
            'password' => 'test',
        ]);

        $post = Post::query()->create([
            'title' => 'Post',
        ]);

        $ownership = Ownership::query()->create([
            'owner_id' => $user->getKey(),
            'owner_type' => $user->getMorphClass(),
            'ownable_id' => $post->getKey(),
            'ownable_type' => $post->getMorphClass(),
        ]);

        $owners = $post->getOwners();
        $ownables = $user->getOwnables();

        dd($owners);
    }
}
