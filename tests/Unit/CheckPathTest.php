<?php

namespace Tests\Unit;

use Tests\TestCase;

class CheckPathTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/add-post');
        $response->assertStatus(200);
    }
}
