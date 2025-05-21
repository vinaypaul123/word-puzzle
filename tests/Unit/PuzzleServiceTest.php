<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PuzzleService;
use App\Exceptions\UsedLettersExceededException;
use App\Exceptions\InvalidWordException;

class PuzzleServiceTest extends TestCase
{
    protected PuzzleService $puzzleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->puzzleService = new PuzzleService();
    }

    /** @test */
    public function it_accepts_valid_word_within_puzzle_letters()
    {
        $puzzle = 'applegrape'; // letters available
        $submittedWord = 'apple';

        $result = $this->puzzleService->validateWord($puzzle, $submittedWord);

        $this->assertTrue($result);
    }

    /** @test */
    public function it_throws_exception_when_word_uses_letters_not_in_puzzle()
    {
        $this->expectException(UsedLettersExceededException::class);

        $puzzle = 'bananaorange';
        $submittedWord = 'kiwi';  // 'k' and 'w' not in puzzle

        $this->puzzleService->validateWord($puzzle, $submittedWord);
    }

    /** @test */
    public function it_throws_exception_for_invalid_word_not_in_dictionary()
    {
        $this->expectException(InvalidWordException::class);

        $puzzle = 'applegrape';
        $submittedWord = 'xyzzy';  // not a valid dictionary word

        $this->puzzleService->validateWord($puzzle, $submittedWord);
    }



}

