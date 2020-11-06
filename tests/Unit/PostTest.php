<?php


namespace biscuit\package\Unit;


use biscuit\package\model\Post;
use biscuit\package\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_create_post()
    {
        $post = Post::factory()->create();

        $this->assertCount(1,Post::all());
    }


}