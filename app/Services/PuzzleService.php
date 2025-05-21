<?php

namespace App\Services;

use App\Models\Puzzle;
use App\Models\Submission;
use App\Models\Student;
use App\Models\Word;
use App\DTOs\SubmissionDTO;
use App\Exceptions\InvalidWordException;
use App\Exceptions\UsedLettersExceededException;

class PuzzleService
{
    public function validateAndScore(SubmissionDTO $dto): Submission
    {
        $puzzle = Puzzle::findOrFail($dto->puzzle_id);
       // $student = Student::findOrFail($dto->student_id);

        $submittedWord = strtolower($dto->word);

        // Check if the submitted word exists in the 'words' table
        if (!Word::where('word', $submittedWord)->exists()) {
            throw new InvalidWordException("Word not found in dictionary.");
        }

        $availableLetters = str_split(strtolower($puzzle->puzzle));
        $submittedLetters = str_split($submittedWord);

        foreach ($submittedLetters as $letter) {
            $key = array_search($letter, $availableLetters);
            if ($key === false) {
                throw new UsedLettersExceededException("Used letter not in puzzle or overused.");
            }
            unset($availableLetters[$key]);
        }

        $score = strlen($submittedWord); // Simple scoring based on length

        return Submission::create([
            'student_id' => $dto->student_id,
            'puzzle_id' => $dto->puzzle_id,
            'word' => $submittedWord,
            'score' => $score,
            'remaining_letters' => array_values($availableLetters),
        ]);
    }
}
