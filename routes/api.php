<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {

    // Mobilról érkező adatok mentése és szinkronizálása
    Route::post('/mobile/sync', function (Request $request) {
        $validated = $request->validate([
            'device_id' => 'required|string',
            'payload'   => 'required|array',
        ]);

       
        return response()->json([
            'status' => 'success',
            'message' => 'Adatok szinkronizálva!',
            'timestamp' => now()
        ], 200);
    });

});