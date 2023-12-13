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
}
