<?php

use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizationController;
use Laravel\Passport\Http\Controllers\ClientController;
use Laravel\Passport\Http\Controllers\PersonalAccessTokenController;
use Laravel\Passport\Http\Controllers\TransientTokenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Маршруты OAuth
Route::group(['middleware' => 'web'], function () {
    Route::get('oauth/authorize', [AuthorizationController::class, 'authorize'])->name('passport.authorizations.authorize');
    Route::post('oauth/token', [AccessTokenController::class, 'issueToken'])->name('passport.token');
    Route::post('oauth/token/refresh', [TransientTokenController::class, 'refresh'])->name('passport.token.refresh');
    Route::post('oauth/clients', [ClientController::class, 'store'])->name('passport.clients.store');
    Route::get('oauth/clients', [ClientController::class, 'forUser'])->name('passport.clients.index');
    Route::delete('oauth/clients/{client_id}', [ClientController::class, 'destroy'])->name('passport.clients.destroy');
    Route::put('oauth/clients/{client_id}', [ClientController::class, 'update'])->name('passport.clients.update');
    Route::post('oauth/personal-access-tokens', [PersonalAccessTokenController::class, 'store'])->name('passport.personal.tokens.store');
    Route::get('oauth/personal-access-tokens', [PersonalAccessTokenController::class, 'forUser'])->name('passport.personal.tokens.index');
    Route::delete('oauth/personal-access-tokens/{token_id}', [PersonalAccessTokenController::class, 'destroy'])->name('passport.personal.tokens.destroy');
});

