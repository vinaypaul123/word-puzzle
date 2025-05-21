<?php

namespace App\Exceptions;

use Exception;

class UsedLettersExceededException extends Exception
{
    protected $message = 'The word uses letters not available in the puzzle.';
}
