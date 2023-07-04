<?php

use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Database\Seeders\QuizSeeder;
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

Route::get('/', function () {
    return redirect('/quizzes');
});

Route::group(['prefix' => 'quizzes'], function () {
    Route::get('/', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/create', [QuizController::class, 'create'])->name('quizzes.create')->middleware('auth');
    Route::post('/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
    Route::get('/{quiz}', [QuizController::class, 'show'])->name('quizzes.show')->middleware('auth');
    Route::post('/store', [QuizController::class, 'store'])->name('quizzes.store')->middleware('auth');
});


// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// User Authentication
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('users.authenticate');
