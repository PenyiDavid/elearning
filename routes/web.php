<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tesztek', [TestController::class, 'showTesztForm']);   // Teszt form megjelenítése
Route::post('/tesztek/{tantargy}', [TestController::class, 'startTeszt']); // Teszt kezdés
Route::post('/tesztkitoltes', [TestController::class, 'submitTeszt']); // Teszt beküldése

// Eredmények megtekintése
Route::post('/eredmenyem', [ScoreController::class, 'eredmenyem']); // Eredmény oldal

// Új tárgy hozzáadása
Route::get('/ujtargy', [SubjectController::class, 'create']);
Route::post('/ujtargy', [SubjectController::class, 'store']);

// Új kérdés hozzáadása
Route::get('/ujkerdes', [QuestionController::class, 'create']);
Route::post('/ujkerdes', [QuestionController::class, 'store']);

// Eredmények listázása és szűrése
Route::get('/eredmenyek', [ScoreController::class, 'listEredmenyek']);

// Kérdések megjelenítése, szerkesztése és törlése
Route::get('/kerdesek', [QuestionController::class, 'index']);
Route::get('/kerdesek/{id}', [QuestionController::class, 'edit']);
Route::post('/kerdesek/{id}', [QuestionController::class, 'update']);
Route::delete('/kerdesek/{id}', [QuestionController::class, 'destroy']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
