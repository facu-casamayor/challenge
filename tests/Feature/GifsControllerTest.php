<?php

namespace Tests\Feature;

use App\Models\Gif;
use Auth;
use Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GifsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void {
        parent::setUp();

        // Configurar la autenticación de Sanctum para las pruebas
        $this->actingAs(User::factory()->create());
    }

    public function testSearch(){
        $response = $this->postJson("/api/search", [
            "query"=>"cats",
            "limit"=>2,
            "offset"=>0
        ]);

        
        $response->assertJsonStructure([
            "data"=>[
                "0"=>[
                    "type",
                    "url",
                    "title"
                ]
            ]
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount("api_logs", 1);
        $this->assertDatabaseHas("api_logs", [
            "user_id"=> Auth::user()->id,
            "status_code"=> 200
        ]);
    }

    public function testSave(){
        $response = $this->postJson("/api/save", [
            "alias"=>"bu0ny50PolCRTVb49N",
            "user_id"=>Auth::user()->id
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "message"=>"Gif saved",
            "gif_id"=>$response->json("gif_id")
        ]);

        $this->assertDatabaseHas("api_logs",[
            "user_id"=> Auth::user()->id,
            "status_code"=> 200
        ]);
    }

    public function testGetById(){
        Gif::create([
            "alias"=>"bu0ny50PolCRTVb49N",
            "user_id"=>Auth::user()->id
        ]);
        
        $response = $this->getJson("/api/search/1");

        $response->assertStatus(200);

        $this->assertDatabaseHas("api_logs",[
            "user_id"=> Auth::user()->id,
            "status_code"=> 200
        ]);
    }
}
