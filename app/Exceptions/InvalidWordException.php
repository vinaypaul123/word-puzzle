<?php

namespace App\Exceptions;

use Exception;

class InvalidWordException extends Exception
{
    protected $message = 'The submitted word is invalid.';
}
