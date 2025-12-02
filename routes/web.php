<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.session'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::resource('produtos', ProdutoController::class);
    Route::resource('categorias', CategoriaController::class);
});

Route::post('/toggle-theme', function () {
    $currentTheme = request()->cookie('theme', 'light');
    $newTheme = $currentTheme === 'light' ? 'dark' : 'light';
    
    return response()->json(['theme' => $newTheme])
        ->cookie('theme', $newTheme, 60 * 24 * 365);
})->name('toggle.theme');
