<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\PlaceController;

/*
|--------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will be
| assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------- 
| Web Routes
|-------------------------------------------------------------------------- 
*/

// Роуты для аутентификации
Route::get('/auth/signup', [AuthController::class, 'signup'])->name('register');
Route::post('/auth/registr', [AuthController::class, 'registr'])->name('registr'); 
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('signin');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');


// Роуты для авторизованных пользователей
Route::middleware('auth')->group(function () {
    // Управление объектами (things)
     //Route::resource('things', ThingController::class);

    // Управление местами хранения (places)
    Route::resource('places', PlaceController::class);

    // Роуты для вещей в разных состояниях
    Route::get('/things/repair', [ThingController::class, 'repairThings'])->name('things.repair');
    Route::get('/things/work', [ThingController::class, 'workThings'])->name('things.work');
    Route::get('/things/used', [ThingController::class, 'usedThings'])->name('things.used');
    Route::get('/things/all', [ThingController::class, 'allThings'])->name('things.all');
    
    // Роуты для пользователя
    Route::get('/things/my', [ThingController::class, 'myThings'])->name('things.my');
    Route::get('/things/{thing}', [ThingController::class, 'show'])->name('things.show');
    
    // Роуты для администраторов
    Route::middleware('can:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard'); 
        })->name('admin.dashboard');
    });
});

// Главная страница
Route::get('/', function () {
    return view('layout');
});

