<?php

namespace Juanfrita\QrGenerator\Core;

use Juanfrita\QrGenerator\Exception\ContentNotSupportedException;

class QrCodeEncoding{

    /**
     * Gets the encoding mode for the given subject:
     * - NUMERIC: 1
     * - ALPHANUMERIC: 2
     * - OTHER: 3
     * - LATIN1: 4
     * @param string $subject QR content
     */
    public function calculateEncodingMode(string $subject): int
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
}
