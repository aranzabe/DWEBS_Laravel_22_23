<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
//  use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * https://www.toptal.com/laravel/restful-laravel-api-tutorial
     * https://cosasdedevs.com/posts/test-unitarios-unit-test-en-nuestro-blog-con-laravel-8/
     * https://laravel.com/docs/9.x/http-tests
     * A basic test example.
     *
     * @return void
     */

    public function test_insertar()
    {
        //payload
        $datos = [
            "DNI" => "99999",
            "Nombre" => "Fake",
            "Tfno" => "555 29344",
            "edad" => 18
        ];



        $this->json('post', '/api/insertarpersona', $datos)
            ->assertStatus(200)
            ->assertJson([
                'mens' => 'Inserción ok',
            ]);

        $this->json('post', '/api/insertarpersona', $datos)
            ->assertStatus(404)
            ->assertJson([
                'mens' => 'Clave duplicada',
            ]);

    }

    public function test_insertar2()
    {
        $datos = [
            "DNI" => "99979",
            "Nombre" => "Fake",
            "Tfno" => "555 29344",
            "edad" => 18
        ];


        $response = $this->post('/api/insertarpersona', $datos);
        $response->assertJson(['mens' => 'Inserción ok']);
        $response->assertStatus(200);

        $response = $this->post('/api/insertarpersona', $datos);
        $response->assertJson(['mens' => 'Clave duplicada']);
        $response->assertStatus(404);
    }

    public function test_buscar_persona() {
        $this->json('get', '/api/buscarpersona/99999')
        ->assertStatus(200)
        ->assertJson(["DNI" => "99999", "Nombre" => "Fake", "Tfno" => "555 29344", "edad" => "18"])
        ->assertJsonStructure([
            'DNI', 'Nombre', "Tfno", "edad"]);
    }

    public function test_buscar_persona2() {
        $response = $this->get('/api/buscarpersona/99979');
        $response->assertJson(["DNI" => "99979", "Nombre" => "Fake", "Tfno" => "555 29344", "edad" => "18"]);
        $response->assertStatus(200);
    }


    public function test_borrar()
    {
        $this->json('delete', '/api/borrarpersona/99999')
            ->assertStatus(200)
            ->assertJson([
                'mens' => 'Borrado',
            ]);

        $this->json('delete', '/api/borrarpersona/99999')
            ->assertStatus(200)
            ->assertJson([
                'mens' => 'No encontrado',
            ]);
    }

    public function test_borrar2(){
        $response = $this->delete('/api/borrarpersona/99979');
        $response->assertJson(['mens' => 'Borrado']);
        $response->assertStatus(200);

        $response = $this->delete('/api/borrarpersona/99979');
        $response->assertJson(['mens' => 'No encontrado']);
        $response->assertStatus(200);
    }
}
