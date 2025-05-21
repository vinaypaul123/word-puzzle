<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Puzzle;
use App\Models\Student;
use App\Models\Word;
use App\Services\PuzzleService;
use App\DTOs\SubmissionDTO;
use App\Exceptions\InvalidWordException;
use App\Exceptions\UsedLettersExceededException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PuzzleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PuzzleService $puzzleService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->puzzleService = new PuzzleService();
    }

    /** @test */
    public function it_accepts_valid_word_within_puzzle_letters()
    {
        $puzzle = Puzzle::create(['puzzle' => 'applegrape']);
        $student = Student::create(['name' => 'John Doe']);
        Word::create(['word' => 'apple']); // Make sure this exists in dictionary

        $dto = new SubmissionDTO(
            word: 'apple',
            student_id: $student->id,
            puzzle_id: $puzzle->id
        );

        $submission = $this->puzzleService->validateAndScore($dto);

        $this->assertEquals('apple', $submission->word);
        $this->assertEquals(5, $submission->score);
    }

    /** @test */
    public function it_throws_exception_for_invalid_word_not_in_dictionary()
    {
        $this->expectException(InvalidWordException::class);

        $puzzle = Puzzle::create(['puzzle' => 'applegrape']);
        $student = Student::create(['name' => 'Jane Doe']);

        $dto = new SubmissionDTO(
            word: 'xyzzy',
            student_id: $student->id,
            puzzle_id: $puzzle->id
        );

        $this->puzzleService->validateAndScore($dto);
    }

    /** @test */
    public function it_throws_exception_when_word_uses_invalid_letters()
    {
        $this->expectException(UsedLettersExceededException::class);

        $puzzle = Puzzle::create(['puzzle' => 'bananaorange']);
        $student = Student::create(['name' => 'Alice']);
        Word::create(['word' => 'kiwi']); // Valid dictionary word

        $dto = new SubmissionDTO(
            word: 'kiwi',
            student_id: $student->id,
            puzzle_id: $puzzle->id
        );

        $this->puzzleService->validateAndScore($dto);
    }
}
