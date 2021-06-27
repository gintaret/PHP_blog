<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class InsertPostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
       $user = User::factory()->create();
       $post = Post::factory()->count(10)->create();

       $response = $this->actingAs($user)->post('/add-post');
       $response->assertSeeText('Postas sukurtas');
    }
}
