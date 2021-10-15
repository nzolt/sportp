<?php


namespace App\Exceptions;

use Throwable;

class InvalidDataException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Invalid Data. Rent start - end didn\'t match.', 1001, $previous);
    }
}