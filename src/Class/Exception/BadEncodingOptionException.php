<?php

namespace Juanfrita\QrGenerator\Exception;

use Exception;
use Throwable;

class BadEncodingOptionException extends Exception
{
    public function __construct(string $message = "Bad Encoding option: Available options are 1 (Numeric), 2 (Alphanumeric), 3 (Other), 4 (Latin1)", int $code = 0, Throwable $previous = null)
    {
        return parent::__construct($message, $code, $previous);
    }
}
