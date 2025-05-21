<?php
namespace App\Repositories;

use App\Models\Student;
use App\Models\Submission;

use App\DTOs\SubmissionDTO;

class SubmissionRepository
{
    public function create(SubmissionDTO $dto, int $score, array $remainingLetters): Submission
    {
        return Submission::create([
            'student_id'        => $dto->student_id,
            'puzzle_id'         => $dto->puzzle_id,
            'word'              => $dto->word,
            'score'             => $score,
            'remaining_letters' => $remainingLetters,
        ]);
    }

    public function getLeaderboard(int $limit = 10)
    {
      return Student::with(['submissions' => function ($query) {
        $query->orderByDesc('score');
        }])
        ->withSum('submissions', 'score')
        ->orderByDesc('submissions_sum_score')
        ->limit($limit)
        ->get();
    }

}

