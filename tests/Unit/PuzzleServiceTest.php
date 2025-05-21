<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PuzzleService;

class PuzzleServiceTest extends TestCase
{
    protected PuzzleService $puzzleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->puzzleService = new PuzzleService();
    }

    /** @test */
    public function it_validates_a_word_that_exists_in_puzzle_and_wordlist()
    {
        // Arrange
        $puzzle = 'dgeftoikbvxuaa';
        $validWord = 'exit'; // This must exist in your words.txt for test to pass

        // Act
        $result = $this->puzzleService->validateWordWithPuzzle($puzzle, $validWord);

        // Assert
        $this->assertEquals($validWord, $result);
    }

    /** @test */
    public function it_throws_exception_if_word_not_in_wordlist()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Word not found in the Puzzle.');

        $puzzle = 'dgeftoikbvxuaa';
        $invalidWord = 'invalidwordxyz';

        $this->puzzleService->validateWordWithPuzzle($puzzle, $invalidWord);
    }

    /** @test */
    public function it_throws_exception_if_word_uses_letters_not_in_puzzle()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Word uses letters not available in the puzzle.');

        $puzzle = 'dgeftoikbvxuaa';
        $invalidWord = '//';

        $this->puzzleService->validateWordWithPuzzle($puzzle, $invalidWord);
    }

    /** @test */
    // public function it_checks_if_word_is_valid_english_word()
    // {
    //     // Arrange
    //     $validWord = 'exit';  // must be in words.txt
    //     $invalidWord = 'qwertyuiopasdfghjklzxcvbnm';

    //     // Assert valid word returns true
    //     $this->assertTrue($this->puzzleService->isValidEnglishWord($validWord));
    //     // Assert invalid word returns false
    //     $this->assertFalse($this->puzzleService->isValidEnglishWord($invalidWord));
    // }

    /** @test */
    public function it_calculates_remaining_letters_after_word_is_used()
    {
        $puzzle = 'dgeftoikbvxuaa';
        $word = 'exit';

        $remainingLetters = $this->puzzleService->calculateRemainingLetters($puzzle, $word);

        // The puzzle letters minus letters in 'date'
        // 'dgeftoikbvxuaa' minus d,a,t,e
        // Let's just check that the count is reduced by 4
        $this->assertCount(strlen($puzzle) - strlen($word), $remainingLetters);

        // And the remaining letters array should not contain the letters of the word
        foreach (str_split($word) as $char) {
            $this->assertNotContains($char, $remainingLetters);
        }
    }

    /** @test */
    public function it_calculates_score_based_on_word_length()
    {
        $word = 'exit';
        $score = $this->puzzleService->calculateScore($word);

        $this->assertEquals(strlen($word), $score);
    }
}
