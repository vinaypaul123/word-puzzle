<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\SubmissionController;
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

Route::get('/', fn() => view('welcome'));
Route::get('/puzzle/start', [PuzzleController::class, 'start'])->name('puzzle.start');
Route::post('/submission', [SubmissionController::class, 'submit'])->name('submission.submit');
Route::get('/leaderboard', [SubmissionController::class, 'leaderboard'])->name('leaderboard');

