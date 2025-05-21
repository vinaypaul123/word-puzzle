<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Student;
use App\Models\Puzzle;
use App\DTOs\SubmissionDTO;
use App\Services\PuzzleService;
use App\Exceptions\InvalidWordException;
use App\Exceptions\UsedLettersExceededException;

class SubmissionController extends Controller
{
    public function submit(Request $request, PuzzleService $puzzleService)
    {
        $request->validate([
            'word' => 'required|string',
            'student_id' => 'required|integer|exists:students,id',
            'puzzle_id' => 'required|integer|exists:puzzles,id',
        ]);

        $dto = new SubmissionDTO(
            word: strtolower($request->word),
            student_id: $request->student_id,
            puzzle_id: $request->puzzle_id,
        );

        try {
            $submission = $puzzleService->validateAndScore($dto);

            return back()->with('success', "Word '{$submission->word}' submitted for {$submission->score} points.");
        } catch (InvalidWordException|UsedLettersExceededException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function leaderboard()
    {
        $topSubmissions = Submission::query()
            ->select('word', 'score')
            ->distinct('word')
            ->orderByDesc('score')
            ->limit(10)
            ->get();

        return view('leaderboard', ['leaderboard' => $topSubmissions]);
    }
}
