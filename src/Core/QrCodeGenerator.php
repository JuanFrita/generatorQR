<?php

namespace Juanfrita\QrGenerator\Core;

class QrCodeGenerator
{
    use QrCodeValidatorTrait;

    public function __construct(
        private readonly QrCodeVersion $qrCodeVersion,
        private readonly QrCodeEncoding $qrCodeEncoding,
    ) {
    }

    /**
     * Auto generates a QR code for a subject, with optimal version
     * Auto-calculates version.
     * @param string $subject QR content
     * @throws \Exception
     */
    public function generate(string $subject): mixed
    {
        $encodingMode = $this->qrCodeEncoding->calculateEncodingMode($subject);

        $version = $this->qrCodeVersion->calculateOptimalVersion(strlen($subject), $encodingMode);

        return $this->calculateLengthBits($encodingMode, $version);
    }


    /**
     * Gets the number of bits needed to represent content's length. It's Based on encoding mode
     * and version
     * @param int $mode encoding
     * @param int $version QR version
     * @return int
     */
    public function calculateLengthBits(int $mode, int $version): int
    {
        $modeIndex = (int) floor(log($mode, 2));

        if ($version > 26) {
            $bitsIndex = 2;
        } elseif ($version > 9) {
            $bitsIndex = 1;
        } else {
            $bitsIndex = 0;
        }

        return QRCodeSettings::LENGTH_BITS[$modeIndex][$bitsIndex];
    }

    public function getByteData()
    {
        #TODO implement getByteData function
    }
}
