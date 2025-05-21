<?php

namespace App\Services;

class PuzzleService
{

    // public function generatePuzzle(): string
    //     {
    //         $wordList = file(storage_path('words.txt'), FILE_IGNORE_NEW_LINES);

    //         foreach ($wordList as $baseWord) {
    //                 $baseWord = strtolower(trim($baseWord));

    //                 $alreadySubmitted = Submission::where('word', $baseWord)->exists();

    //                 if (!$alreadySubmitted) {
    //                     $extraLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
    //                     $combined = str_split($baseWord . substr($extraLetters, 0, 7));
    //                     shuffle($combined);
    //                     return implode('', $combined);
    //                 }
    //             }

    //             throw new \Exception("No unused base word available.");
    // }
        public function validateWordWithPuzzle(string $puzzle, string $word)
        {

            $wordList = file(storage_path('words.txt'), FILE_IGNORE_NEW_LINES);

            $word = strtolower(trim($word));

            // Check if the word exists in the word list
            if (!in_array($word, $wordList)) {
                throw new \Exception('Word not found in the Puzzle.');
            }
            // Convert letters to frequency map
            $puzzleLetters = count_chars($puzzle, 1);
            $wordLetters = count_chars($word, 1);

            // Ensure each letter in word exists in puzzle and not used more than allowed
            foreach ($wordLetters as $ascii => $count) {
                if (!isset($puzzleLetters[$ascii]) || $count > $puzzleLetters[$ascii]) {
                    throw new \Exception('Word uses letters not available in the puzzle.');
                }
            }
            return $word;
        }


    // public function isValidEnglishWord(string $word): bool
    // {
    //     static $dictionary = null;

    //     if ($dictionary === null) {
    //             $dictionary = file(storage_path('words.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    //             $dictionary = array_map('strtolower', $dictionary);
    //     }

    //     return in_array(strtolower($word), $dictionary);
    // }

    public function calculateRemainingLetters(string $puzzle, string $word): array
    {
        $letters = str_split($puzzle);
        foreach (str_split($word) as $char) {
            $index = array_search($char, $letters);
            if ($index !== false) {
                unset($letters[$index]);
            }
        }
        return array_values($letters);
    }

    public function calculateScore(string $word): int
    {
        return strlen($word); // Customize as needed
    }
}

