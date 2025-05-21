<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    protected $fillable = ['puzzle'];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
