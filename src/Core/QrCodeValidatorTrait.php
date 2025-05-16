<?php

namespace Juanfrita\QrGenerator\Core;

use Juanfrita\QrGenerator\Exception\BadEncodingOptionException;
use Juanfrita\QrGenerator\Exception\ContentTooLongException;

trait QrCodeValidatorTrait
{
    /**
     * Validates encoding mode
     * @param int $encodingMode
     * @throws \Juanfrita\QrGenerator\Exception\BadEncodingOptionException
     */
    protected function validateEncodingMode(int $encodingMode): void
    {
        if (
            $encodingMode !== QRCodeSettings::ALPHANUMERIC &&
            $encodingMode !== QRCodeSettings::NUMERIC &&
            $encodingMode !== QRCodeSettings::LATIN1 &&
            $encodingMode !== QRCodeSettings::OTHER
        ) {
            throw new BadEncodingOptionException();
        }
    }

    /**
     * Validates max length for encoding mode
     * @param int $lenght
     * @param int $version
     * @return void
     */
    protected function validateMaxLength(int $length, int $mode): void
    {
        $this->validateEncodingMode($mode);

        $maxLength = QrCodeSettings::MAX_CONTENT_LENGTH[$mode];

        if ($length > $maxLength) {
            throw new ContentTooLongException(sprintf(
                'Content length %d exceeds maximum %d for mode %d',
                $length,
                $maxLength,
                $mode
            ));
        }
    }
}
