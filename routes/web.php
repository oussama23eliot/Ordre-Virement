<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParametresController;
use App\Http\Controllers\VirementsController;
use App\Models\Virements;
use Illuminate\Support\Facades\Route;


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

Route::post("/login", [LoginController::class, "Login"])->name("login");
Route::get("/login", [LoginController::class, "getLogin"])->name("getLogin");

Route::get("/logout", [LoginController::class, "Logout"])->name("logout");


Route::get('/virements/pdf/{id}', [VirementsController::class, 'generate_pdf']);
Route::resource('virements', VirementsController::class);

Route::get('/parametres', [ParametresController::class, 'index'])->name('params');
Route::put('/parametres', [ParametresController::class, 'updateAll']);
