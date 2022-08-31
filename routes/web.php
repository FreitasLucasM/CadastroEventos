<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\EventController;
use GuzzleHttp\Middleware;

Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'criar'])->middleware('auth');
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/view', [EventController::class, 'eventos']);
Route::get('/events/view/{id}', [EventController::class, 'show']);
Route::delete('/events/view/{id}', [EventController::class, 'destroy']);
Route::get('/dashboard', [EventController::class, 'myDashboard'])->middleware('auth');
