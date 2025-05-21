<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Student;
use App\Repositories\PuzzleRepository;
use Illuminate\Http\Request;
use App\Services\PuzzleService;
use App\Http\Requests\StoreStudentRequest;

class PuzzleController extends Controller
{
    public function __construct(private PuzzleService $puzzleService) {}

    public function start(PuzzleRepository $repo)
    {
        $studentId = session('student_id');
        $student = Student::findOrFail($studentId);

        $studentId = session('puzzle_id');
        $puzzle = $repo->find($studentId);

        return view('puzzle', compact('puzzle', 'student'));

    }

    public function submitname(StoreStudentRequest $request,PuzzleRepository $repo){

            $student = Student::firstOrCreate(['name' => $request->name]); // Temp student
            session(['student_id' => $student->id]);

            $puzzlestring='dgeftoikbvxuaa';

            // Check if puzzle already exists
            $puzzle = \App\Models\Puzzle::where('puzzle', $puzzlestring)->first();

            if (!$puzzle) {
                // Not found, create new puzzle
                $puzzle = $repo->create($puzzlestring);
            }

            session(['puzzle_id' => $puzzle->id]);

            return redirect()->route('puzzle.start');

    }

    public function startname(Request $request){
        return view('student_name');
    }


}

