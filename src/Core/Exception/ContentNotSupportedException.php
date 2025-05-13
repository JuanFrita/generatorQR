<?php

namespace Juanfrita\QrGenerator\Exception;

use Exception;
use Throwable;

class ContentNotSupportedException extends Exception
{
    public function __construct(string $message = "Content contains unsupported characters", int $code = 0, Throwable $previous = null)
    {
        return parent::__construct($message, $code, $previous);
    }
}
