<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_PonemosLoQueSea()
    {
        $response = $this->get('/api/');

        $response->assertStatus(200);
    }

    public function test_otra_cosa()
    {
        $response = $this->get('/api/loquesea');

        $response->assertStatus(201);
    }


}
