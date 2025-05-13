<?php

namespace Juanfrita\QrGenerator\Core;

use Juanfrita\QrGenerator\Exception\ContentNotSupportedException;
use Juanfrita\QrGenerator\Exception\ContentTooLongException;
use Juanfrita\QrGenerator\Exception\BadEncodingOptionException;
use LogicException;

class QrCodeGenerator
{
    /**
     * Generates a QR code for a subject.
     * Auto-calculates version.
     * @param string $subject QR content
     */
    public function generate(string $subject): mixed
    {
        $encodingMode = $this->getEncodingMode($subject);

        $version = $this->getOptimalVersion(strlen($subject), $encodingMode);

        return $this->getLengthBits($encodingMode, $version);
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
        if (preg_match(QRCodeSettings::NUMERIC_RE, $subject)) {
            return QrCodeSettings::NUMERIC;
        }
        if (preg_match(QrCodeSettings::ALPHANUMERIC_RE, $subject)) {
            return QrCodeSettings::ALPHANUMERIC;
        }
        if (preg_match(QrCodeSettings::LATIN1_RE, $subject)) {
            return QrCodeSettings::LATIN1;
        }
        
        throw new ContentNotSupportedException();
    }

    /**
     * Gets the Optimal QR version. Based on the lenght of the content and encoding mode
     * @param int $length content's length
     * @param int $mode encoding
     */
    public function getOptimalVersion(int $length, int $mode): int{
        $encodingIndex = QrCodeSettings::VERSION_INDEX[$mode] ?? throw new BadEncodingOptionException();

        $maxLength = QrCodeSettings::MAX_CONTENT_LENGTH[$mode];

        if($length > $maxLength){
            throw new ContentTooLongException(sprintf(
                'Content length %d exceeds maximum %d for mode %d',
                $length,
                $maxLength,
                $mode
            ));
        }

        foreach (QrCodeSettings::VERSION_TABLE as $config) {
            if($length <= $config[$encodingIndex]){
                return end($config); //version is last Index
            }
        }

        throw new LogicException('No suitable QR version found. Configuration may be incomplete.');
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

        return QrCodeSettings::LENGTH_BITS[$modeIndex][$bitsIndex];
    }

    public function getByteData()
    {
        #TODO implement getByteData function
    }
}
