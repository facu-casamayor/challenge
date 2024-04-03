<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserRegister(){
        //Crear un usuario
        $user = User::factory()->make();

        //Registrarlo con la API
        $response = $this->postJson('/api/register', ["email"=> $user->email, "password"=>$user->password]);
        
        //Assert
        $response->assertCreated();
        $this->assertDatabaseHas("users", [
            "email"=> $user->email
        ]);
    }

    public function testUserLogin(){
        //Crear usuario en DB
        $user = User::factory()->create([
            "password"=> Hash::make("password123")
        ]);

        //Accederlo con la API
        $response = $this->post('api/login', array('email'=>$user->email, 'password'=>"password123"));

        
        //Assert que devuelva datos
        $response->assertJsonStructure([
            'message',
            'token',
            'token_type',
            'token_duration'
        ]);

        $response->assertStatus(201);

        $response->assertJson(["message"=>"User logged"]);

        $this->assertDatabaseHas("api_logs", [
            "user_id"=> $user->id,
            "status_code"=>201
        ]);
    }
}
