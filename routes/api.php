<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Player;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* 
    Códigos de error del cliente (4xx)

    400 Bad Request: La solicitud no se puede procesar debido a un error en la solicitud. Por ejemplo, la solicitud puede estar mal formada o puede faltar información.
    401 Unauthorized: El cliente no está autorizado para realizar la solicitud. Por ejemplo, el cliente no ha proporcionado las credenciales adecuadas.
    403 Forbidden: El cliente está autorizado para realizar la solicitud, pero no se le permite realizarla. Por ejemplo, el cliente no tiene los permisos adecuados.
    404 Not Found: El recurso solicitado no existe.
    405 Method Not Allowed: El método HTTP utilizado para la solicitud no está permitido para el recurso solicitado.
    409 Conflict: La solicitud no se puede completar debido a un conflicto. Por ejemplo, el recurso solicitado ya existe.
    410 Gone: El recurso solicitado ya no está disponible.
    415 Unsupported Media Type: El tipo de contenido de la solicitud no es compatible con el recurso solicitado.
    422 Unprocessable Entity: La solicitud no se puede procesar debido a un error en los datos de la solicitud. Por ejemplo, los datos pueden estar mal formados o pueden ser incorrectos.
*/

/*
    Códigos de error del servidor (5xx)

    500 Internal Server Error: Se ha producido un error en el servidor.
    502 Bad Gateway: El servidor proxy no ha podido obtener una respuesta del servidor de destino.
    503 Service Unavailable: El servidor no está disponible temporalmente.
    504 Gateway Timeout: El servidor proxy no ha recibido una respuesta del servidor de destino antes de que expirara el tiempo de espera.
    505 HTTP Version Not Supported: El servidor no admite la versión HTTP utilizada en la solicitud.
*/

Route::middleware( 'auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});


Route::get('/ranking', [ApiController::class, 'index']);
Route::get('/check-position/{score}', [ApiController::class, 'checkPosition']);
Route::get('/top1', [ApiController::class, 'getTop1']);

Route::post('/new-player', [ApiController::class, 'newPlayer']);

/* Se van a subir todos, y que sql calcule solo */