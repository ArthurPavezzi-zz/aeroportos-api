<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('airports', [ApiController::class, 'getAllAirports']);

Route::get('airports/{id}', [ApiController::class, 'getSingleAirport']);

$otherVerbs = ['delete', 'options', 'patch', 'post', 'put'];
Route::match($otherVerbs, 'airports', [ApiController::class, 'handleOtherVerbs']);

Route::match($otherVerbs, 'airports/{id}', [ApiController::class, 'handleOtherVerbs']);
