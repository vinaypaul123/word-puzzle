<?php

namespace App\Repositories;

use App\Models\Puzzle;

class PuzzleRepository
{
    public function create(string $letters): Puzzle
    {
        return Puzzle::create(['puzzle' => $letters]);
    }

    public function find(int $id): ?Puzzle
    {
        return Puzzle::find($id);
    }
}
