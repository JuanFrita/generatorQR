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

    /**
     * Generates a QR code for a subject.
     * Auto-calculates version.
     * @param string $subject QR content
     */
    public function generate(string $subject): mixed
    {
        $encodingMode = $this->getEncodingMode($subject);

        return $this->getLengthBits($encodingMode, 2);
    }

    /**
     * Gets the encoding mode for the given subject:
     * - NUMERIC: 1
     * - ALPHANUMERIC: 2
     * - OTHER: 3
     * - LATIN1: 4
     * @param string $subject QR content
     */
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

    /**
     * Gets the QR version. Based on the lenght of the content and encoding mode
     * @param int $length content's length
     * @param int $mode encoding
     */
    public function getVersion(int $length, int $mode): int{
        #TODO finsih implementation and configuration of getVersion function
        return $length - $mode;
    }

    /**
     * Gets the number of bits needed to represent content's length. It's Based on encoding mode
     * and version
     * @param int $mode encoding
     * @param int $version QR version
     * @return int
     */
    public function getLengthBits(int $mode, int $version): int
    {
        $modeIndex = (int) floor(log($mode, 2));

        if ($version > 26) {
            $bitsIndex = 2;
        } elseif ($version > 9) {
            $bitsIndex = 1;
        } else {
            $bitsIndex = 0;
        }

        return self::LENGTH_BITS[$modeIndex][$bitsIndex];
    }

    public function getByteData()
    {
        #TODO implement getByteData function
    }

}
