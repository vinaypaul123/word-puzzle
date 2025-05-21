<?php

namespace App\DTOs;

class SubmissionDTO {
    public string $word;
    public int $student_id;
    public int $puzzle_id;

    public function __construct(string $word, int $student_id, int $puzzle_id)
    {
        $this->word = $word;
        $this->student_id = $student_id;
        $this->puzzle_id = $puzzle_id;
    }
}
