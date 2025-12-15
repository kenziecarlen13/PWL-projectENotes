<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

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

/**
 * Endpoint User (Default Laravel)
 * Mengembalikan data user yang terautentikasi via Token.
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * ------------------------------------------------------------------------
 * Public Note Endpoints (Read-Only)
 * ------------------------------------------------------------------------
 * Menyediakan akses data catatan dalam format JSON untuk pihak ketiga
 * atau integrasi frontend eksternal. Menggunakan NoteResource untuk formatting.
 */

// Mengambil seluruh daftar catatan (Collection)
Route::get('/notes', [NoteController::class, 'index']);

// Mengambil detail satu catatan spesifik berdasarkan ID (Single Resource)
Route::get('/notes/{id}', [NoteController::class, 'show']);