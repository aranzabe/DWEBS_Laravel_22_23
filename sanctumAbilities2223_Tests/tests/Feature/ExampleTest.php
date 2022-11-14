<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExampleTest extends TestCase
{
    public function test_RegistersSuccessfully()
    {
        $datos = [
            "name" => "Fernando3",
            "email" => "faranzabe3@gmail.com",
            "password" => "1234",
            "confirm_password" => "1234",
            "departamento" => "Informática",
            "edad" => "92",
            "cargo" => "Padawan"
        ];

        $this->json('post', '/api/register', $datos)
            ->assertStatus(201)
            ->assertJsonStructure([
                "success", "data" => ["token","name"], "message"]);
    }

    public function test_RequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(400)
            ->assertJson([
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function test_RequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@toptal.com',
            'password' => 'toptal123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(400)
            ->assertJson([
                'confirm_password' => ['The confirm password field is required.'],
            ]);
    }

    public function test_InsertarParte()
    {


        if(Auth::attempt(['email' => 'faranzabe3@gmail.com', 'password' => '1234'])){
            $auth = Auth::user();
        }
        $datos = [
            "alumno" => "Manuel",
            "gravedad" => "Leve",
            "idprofesor" => $auth->id,
            "observaciones"=> "Por lo de las manzanas"
        ];

        $token = $auth->createToken('access_token_test')->plainTextToken;
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('POST', '/api/parte', $datos, $headers)
            ->assertStatus(200);
    }

    public function test_Logout() {
        if(Auth::attempt(['email' => 'faranzabe3@gmail.com', 'password' => '1234'])){
            $auth = Auth::user();
        }
        $datos =[
            "email" => "faranzabe3@gmail.com",
            "password" => "1234"
        ];
        $this->json('post', '/api/logout',$datos)
            ->assertStatus(200);
        $result = User::where('id',$auth->id)->delete();
    }

}
