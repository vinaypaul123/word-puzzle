<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DTOs\SubmissionDTO;
use App\Repositories\SubmissionRepository;
use App\Services\PuzzleService;
use App\Models\Submission;
use App\Models\Student;
use App\Http\Requests\StoreSubmissionRequest;

class SubmissionController extends Controller
{

    public function submit(StoreSubmissionRequest $request, SubmissionRepository $repo, PuzzleService $service)
    {
        $dto = new SubmissionDTO(
            $request->word,
            $request->student_id,
            $request->puzzle_id
        );

        try {
            $puzzle = \App\Models\Puzzle::findOrFail($dto->puzzle_id);

            // Check if the word has already been submitted
            $alreadySubmitted = Submission::where('student_id', $dto->student_id)
            ->where('puzzle_id', $dto->puzzle_id)
            ->where('word', $dto->word)
            ->exists();

            if ($alreadySubmitted) {
                return back()->with('error',  'You have already submitted this word. Try another one.');
            }

            try {
                $service->validateWordWithPuzzle($puzzle->puzzle, $dto->word);
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
            $remaining = $service->calculateRemainingLetters($puzzle->puzzle, $dto->word);
            $score = $service->calculateScore($dto->word);

            $submission = $repo->create($dto, $score, $remaining);

            return redirect()->route('puzzle.start')->with('success', 'Word submitted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function endgame(Request $request)
    {
        session()->forget('puzzle_id');
        session()->forget('student_id');
        return redirect()->route('leaderboard');
    }

    public function leaderboard(SubmissionRepository $repo)
    {
        $leaderboard = $repo->getLeaderboard();
        return view('leaderboard', compact('leaderboard'));
    }
}

