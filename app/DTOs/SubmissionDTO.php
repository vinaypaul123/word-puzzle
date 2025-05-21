<?php

namespace App\DTOs;

class SubmissionDTO {
    public function __construct(
        public readonly string $word,
        public readonly int $student_id,
        public readonly int $puzzle_id,
    ) {}
}
