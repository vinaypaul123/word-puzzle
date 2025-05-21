<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;
use App\Models\Word;
use App\Models\Student;

class PuzzleController extends Controller
{

 public function start(Request $request)
    {
        $student = Student::create([
            'name' => $request->query('name', 'Anonymous')
        ]);

        $dictionary = [
            'apple', 'banana', 'orange', 'grape', 'melon',
            'pear', 'peach', 'plum', 'kiwi', 'mango'
        ];

        $randomWord = $dictionary[array_rand($dictionary)];

        // Add 5 random extra letters to increase difficulty
        $extra = str_split('abcdefghijklmnopqrstuvwxyz');
        shuffle($extra);

        $puzzleLetters = array_merge(str_split($randomWord), array_slice($extra, 0, 5));
        shuffle($puzzleLetters);

        $shuffledPuzzle = implode('', $puzzleLetters);

        // Save the puzzle
        $puzzle = Puzzle::create([
            'puzzle' => $shuffledPuzzle
        ]);

        // Check which words from our dictionary can be made from the puzzle
        foreach ($dictionary as $word) {
            if ($this->canFormWord($word, $shuffledPuzzle)) {
                Word::firstOrCreate(['word' => $word]);
            }
        }
        return view('puzzle', [
                    'puzzle' => $puzzle,
                    'student' => $student
        ]);
        //echo "Generated puzzle: $shuffledPuzzle (base word: $randomWord)\n";
    }

    private function canFormWord(string $word, string $puzzle): bool
    {
        $available = str_split($puzzle);

        foreach (str_split($word) as $letter) {
            $index = array_search($letter, $available);
            if ($index === false) {
                return false;
            }
            unset($available[$index]);
        }

        return true;
    }

}
