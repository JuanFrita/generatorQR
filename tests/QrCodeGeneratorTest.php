<?php

namespace Juanfrita\QrGenerator\Tests;

use Juanfrita\QrGenerator\Core\QrCodeEncoding;
use Juanfrita\QrGenerator\Core\QrCodeGenerator;
use Juanfrita\QrGenerator\Core\QrCodeVersion;

class QrCodeGeneratorTest
{
    #TEST LENGTH BITS

    public function testGetLengthBits()
    {
        $qrGenerator = $this->getQrCodeGenerator();
        $lengthBits = $qrGenerator->calculateLengthBits(4, 2);
        assert($lengthBits === 8, "Length must be 8 for mode 4 version 2");
    }

    #AUX

    private function getQrCodeGenerator()
    {
        return new QrCodeGenerator(
            new QrCodeVersion(),
            new QrCodeEncoding(),
        );
    }
}
