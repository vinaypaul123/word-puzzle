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
Route::get('/puzzle/start', [PuzzleController::class, 'start'])->name('puzzle.start')->middleware('check.name');

Route::post('/submission', [SubmissionController::class, 'submit'])->name('submissionvalue.submit');
Route::get('/puzzle/name', [PuzzleController::class, 'startname'])->name('puzzle.name');
Route::post('/submit-name', [PuzzleController::class, 'submitname'])->name('submission.submitname');
Route::get('/leaderboard', [SubmissionController::class, 'leaderboard'])->name('leaderboard');
Route::get('/endgame', [SubmissionController::class, 'endgame'])->name('endgame');


