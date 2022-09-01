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
Route::delete('/events/view/{id}', [EventController::class, 'destroy'])->middleware('auth');
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');
Route::post('/events/participate/{id}', [EventController::class, 'participate'])->middleware('auth');
Route::delete('/events/leave/{id}', [EventController::class, 'delete'])->middleware('auth');
Route::get('/dashboard', [EventController::class, 'myDashboard'])->middleware('auth');
