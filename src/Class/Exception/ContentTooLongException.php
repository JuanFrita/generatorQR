<?php

namespace Juanfrita\QrGenerator\Exception;

use Exception;
use Throwable;

class ContentTooLongException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        return parent::__construct($message, $code, $previous);
    }
}
