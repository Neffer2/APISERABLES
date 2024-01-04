<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class ApiController extends Controller
{
    public function index(){
        $players = Player::where('created_at', '>', now()->subDays(1))->limit(10)->orderBy('puntos', 'DESC')->get();

        if ($players){
            $reponse = [
                "status" => "success",
                "code" => 200,
                "message" => "Solicitud exitosa",
                "body" => $players
            ];
        }else {
            $reponse = [
                "status" => "error",
                "code" => 400,
                "message" => "Error en la solicitud"
            ];
        }
        
        return response()->json($reponse);
    }

    public function getTop1(){
        $top1 = Player::where('created_at', '>', now()->subDays(1))->limit(1)->orderBy('puntos', 'DESC')->first();

        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Solicitud exitosa",
            "body" => $top1,
        ];

        if ($top1){
            $response['body'] = $top1;
        }else {
            $response['body'] = '';
        }

        return response()->json($response);
    } 

    public function checkPosition($score){
        $players = Player::where('created_at', '>', now()->subDays(1))->limit(20)->orderBy('puntos', 'DESC')->get();
        $top1 = $players->first();
        $top10 = $players->sortBy('puntos')->first();

        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Solicitud exitosa",
            "body" => "",
        ];

        if ((!$top1) || ($score >= $top1->puntos)){
            $response['body'] = 'top1';
            return response()->json($response);
        }

        if ($players->count() < 10){
            $response['body'] = 'top10';
            return response()->json($response);
        }
        
        if ($score > $top10->puntos){
            $response['body'] = 'top10';
            return response()->json($response);
        }
        
        $response['body'] = 'none';
        return response()->json($response); 
    }

    public function newPlayer(Request $request){

        $request->validate([
            'nombre' => 'required|string',
            'mensaje' => 'nullable|string',
            'puntos' => 'required|numeric',
        ]);

        $player = new Player;
        $player->nombre = substr($request->nombre, 0, 50);
        if ($request->mensaje){
            $player->mensaje = substr($request->mensaje, 0, 80);
        }
        $player->puntos = $request->puntos;
        $player->skin = NULL;        

        if ($player->save()){
            $response = [
                "status" => "success",
                "code" => 200,
                "message" => "Solicitud exitosa",
                "body" => "",
            ];

            return response()->json($response);
        }
    }
}
