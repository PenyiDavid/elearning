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

Route::get('/tesztek', [TestController::class, 'showTesztForm'])->name('showTesztForm'); // Teszt form megjelenítése
Route::post('/tesztek/{tantargy}', [TestController::class, 'startTeszt'])->name('startTeszt'); // Teszt kezdés
Route::post('/tesztkitoltes', [TestController::class, 'submitTeszt'])->name('submitTeszt'); // Teszt beküldése

// Eredmények megtekintése
Route::post('/eredmenyem', [ScoreController::class, 'eredmenyem'])->name('showResult'); // Eredmény oldal

// Új tárgy hozzáadása
Route::get('/ujtargy', [SubjectController::class, 'create'])->name('createSubject');
Route::post('/ujtargy', [SubjectController::class, 'store'])->name('storeSubject');

// Új kérdés hozzáadása
Route::get('/ujkerdes', [QuestionController::class, 'create'])->name('createQuestion');
Route::post('/ujkerdes', [QuestionController::class, 'store'])->name('storeQuestion');

// Eredmények listázása és szűrése
Route::get('/eredmenyek', [ScoreController::class, 'listEredmenyek'])->name('listResults');

// Kérdések megjelenítése, szerkesztése és törlése
Route::get('/kerdesek', [QuestionController::class, 'index'])->name('indexQuestions');
Route::get('/kerdesek/{id}', [QuestionController::class, 'edit'])->name('editQuestion');
Route::post('/kerdesek/{id}', [QuestionController::class, 'update'])->name('updateQuestion');
Route::delete('/kerdesek/{id}', [QuestionController::class, 'destroy'])->name('destroyQuestion');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
