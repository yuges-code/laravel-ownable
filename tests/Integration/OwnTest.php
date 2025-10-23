<?php

namespace Yuges\Ownable\Tests\Integration;

use Yuges\Ownable\Tests\TestCase;
use Yuges\Ownable\Models\Ownership;
use Illuminate\Support\Facades\Auth;
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

        Auth::setUser($user);

        $post = Post::query()->create([
            'title' => 'Post',
        ]);

        if (! $post->isOwn($user)) {
            $post->own($user);
        }

        $this->assertDatabaseHas(Ownership::getTableName(), [
            'ownable_id' => $post->getKey(),
            'ownable_type' => $post->getMorphClass(),
            'owner_id' => $user->getKey(),
            'owner_type' => $user->getMorphClass(),
        ]);

        $post->unown($user);

        $this->assertDatabaseMissing(Ownership::getTableName(), [
            'ownable_id' => $post->getKey(),
            'ownable_type' => $post->getMorphClass(),
            'owner_id' => $user->getKey(),
            'owner_type' => $user->getMorphClass(),
        ]);
    }
}
