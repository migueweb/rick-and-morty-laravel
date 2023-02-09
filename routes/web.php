<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
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

Route::get('/', function () {
    return view('welcome');
});


/* Characters */
/* Get all characters */
Route::get('/characters', [CharacterController::class, 'index'])->middleware(['auth', 'verified'])->name('characters');
/* Get single characters */
Route::post('/characters/character/{id}', [CharacterController::class, 'show'])->middleware(['auth', 'verified'])->name('characters.show');
/* Store a favorite character */
Route::post('/characters/favorite', [CharacterController::class, 'store'])->middleware(['auth', 'verified'])->name('characters.store');
/* Get favorites characters */
Route::get('/dashboard', [CharacterController::class, 'favorites'])->middleware(['auth', 'verified'])->name('dashboard');
/* Destroy favorites characters */
Route::post('/dashborad/destroy/{id}', [CharacterController::class, 'destroy'])->middleware(['auth', 'verified'])->name('characters.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
