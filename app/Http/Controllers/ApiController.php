<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class ApiController extends Controller
{
    public function index(){
        $players = Player::limit(10)->orderBy('puntos', 'DESC')->get();

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

    public function checkPosition($score){
        $top1 = Player::limit(1)->orderBy('puntos', 'DESC')->first();
        $top10 = Player::limit(1)->orderBy('puntos', 'ASC')->first();

        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Solicitud exitosa",
            "body" => "",
        ];

        if ($score > $top1->puntos){
            $response['body'] = 'top1';

            return response()->json($response);
        }elseif ($score > $top10->puntos){
            $response['body'] = 'top10';

            return response()->json($response);
        }
        
        $response['body'] = 'none';
        return response()->json($response); 
    }

    public function newPlayer(Request $request){

        $player = new Player;
        $player->nombre = $request->nombre;
        $player->mensaje = $request->mensaje;
        $player->puntos = $request->puntos;
        $player->skin = NULL;
        $player->save();

        $response = [
            "status" => "success",
            "code" => 200,
            "message" => "Solicitud exitosa",
            "body" => "",
        ];

        return response()->json($response);
    }
}
