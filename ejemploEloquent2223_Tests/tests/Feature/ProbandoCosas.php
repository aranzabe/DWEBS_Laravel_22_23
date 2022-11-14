<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProbandoCosas extends TestCase
{
    /**
     * A basic feature test example.
     * vendor/bin/phpunit --filter test_prueba tests/Feature/ProbandoCosas.php
     * @return void
     */
    public function test_prueba()
    {
        $this->json('get', '/api/buscarpersona/1A')
        ->assertStatus(200)
        ->assertJson(["DNI" => "1A", "Nombre" => "Isabel", "Tfno" => "1", "edad" => "9"])
        ->assertJsonStructure([
            'DNI', 'Nombre', "Tfno", "edad"]);
    }
}
