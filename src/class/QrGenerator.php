<?php

class QrGenerator
{
    private const NUMERIC_RE = "/^\d*$/";
    private const ALPHANUMERIC_RE = '/^[\dA-Z $%*+\-.\/:]*$/';
    private const LATIN1_RE = '/^[\x{00}-\x{FF}]*$/u';

    //Versions: 1-9, 10-26, 27-40
    private const LENGTH_BITS = [
        [10, 12, 14], //numeric
        [9, 11, 13], //alphanumeric
        [8, 16, 16], //bytes (latin - 1)
    ];


    public function generate(string $subject): mixed
    {
        $encodingMode = $this->getEncodingMode($subject);
        $version = 2;
        
        return $this->getLengthBits($encodingMode, $version);
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

    public function getLengthBits(int $mode, int $version)
    {
        $modeIndex = (int) floor(log($mode, 2));

        $bitsIndex = $version > 26 ? 2 : ($version > 9 ? 1 : 0);

        return self::LENGTH_BITS[$modeIndex][$bitsIndex];
    }

    public function getByteData(){
        #TODO implement this function
    }

}
