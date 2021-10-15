<?php


namespace App\Exceptions;

use Throwable;

class InvalidFileException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('File not found or invalid file format', 1001, $previous);
    }
}