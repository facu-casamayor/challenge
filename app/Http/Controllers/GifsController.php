<?php

namespace App\Http\Controllers;

use App\Models\Gif;
use App\Models\User;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GifsController extends Controller
{
    protected $apiKey = "Z3PRufMb3LIoWRX42MiStLrQM2LGNVrn";

    //Search for a Gif 
    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'query'=> 'required|string|max:100',
            'limit' => 'numeric|min:1|max:50',
            'offset' => 'numeric|max:4999'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $response = Http::get("https://api.giphy.com/v1/gifs/search?api_key=". $this->apiKey ."&q=". $request['query'] ."&limit=". $request['limit'] ."&offset=". $request['offset']);
        
        return json_decode($response->body(), true);
    }

    //Save a Gif
    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'alias' => "required|string",
            "user_id" => "required|numeric|min:1"
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //Check if user is in Database
        $user = User::find($request->user_id);
        if($user === null){
            return response()->json(['error'=>"User not found"], 404);
        }

        $gif = Gif::create([
            "alias"=>$request->alias,
            "user_id"=>$request->user_id
        ]);

        return response()->json([
            "message"=>"Gif saved",
            "gif_id" => $gif->id
        ], 200);
    }

    //Get Gif by ID
    public function getById($id = null){

        $validator = Validator::make(['id'=>$id], [
            'id'=>'required|numeric|min:1'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $gif = Gif::find($id);

        if($gif === null){
            return response()->json(["error" => "Gif not found"], 404);
        }

        $response = Http::get("https://api.giphy.com/v1/gifs/".$gif->alias."?api_key=". $this->apiKey);
        
        return json_decode($response->body(), true);
    }
}
