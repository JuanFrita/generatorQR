<?php

class QrGenerator
{
    private const NUMERIC_RE = "/^\d*$/";
    private const ALPHANUMERIC_RE = '/^[\dA-Z $%*+\-.\/:]*$/';
    private const LATIN1_RE = '/^[\x{00}-\x{FF}]*$/u';

    public function generate(string $subject): mixed
    {
        return $this->getEncodingMode($subject);
    }

    public function getEncodingMode(string $subject): int
    {
        if (preg_match(self::NUMERIC_RE, $subject)) {
            return 0b0001;
        }
        if (preg_match(self::ALPHANUMERIC_RE, $subject)) {
            return 0b0010;
        }
        if (preg_match(self::LATIN1_RE, $subject)) {
            return 0b0100;
        }
        return 0b0111;
    }
}

