<?php

namespace Juanfrita\QrGenerator\Core;

use LogicException;

class QrCodeVersion
{
    use QrCodeValidatorTrait;

    /**
     * Gets the Optimal QR version. Based on the lenght of the content and encoding mode
     * @param int $length content's length
     * @param int $mode encoding
     */
    public function calculateOptimalVersion(int $length, int $mode): int
    {
        $this->validateMaxLength($length, $mode);

        $tableIndex = QrCodeSettings::VERSION_INDEX[$mode];

        foreach (QrCodeSettings::VERSION_TABLE as $config) {
            if ($length <= $config[$tableIndex]) {
                return end($config); //version is last
            }
        }

        throw new LogicException('No suitable QR version found. Configuration may be incomplete.');
    }
}
