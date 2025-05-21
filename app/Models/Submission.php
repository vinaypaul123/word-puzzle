<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
  use HasFactory;

    protected $guarded=['id'];

    protected $fillable = [
        'student_id',
        'puzzle_id',
        'word',
        'score',
        'remaining_letters',
    ];

    protected $casts = [
        'remaining_letters' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function puzzle()
    {
        return $this->belongsTo(Puzzle::class);
    }
}
