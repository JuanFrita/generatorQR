<?php

namespace Juanfrita\QrGenerator\Tests;

use Juanfrita\QrGenerator\Core\QrCodeEncoding;

class QrCodeEncodingTest
{
    #TESTS ENCODING

    public function testEncodeNumber()
    {
        $qrgenerator = new QrCodeEncoding();
        $encodeMode = $qrgenerator->calculateEncodingMode(1);
        assert($encodeMode === 1, "Encode mode must be 1 for digits");
    }

    public function testEncodeAlphaNumeric()
    {
        $qrgenerator = new QrCodeEncoding();
        $encodeMode = $qrgenerator->calculateEncodingMode("ABC123ZXY");
        assert($encodeMode === 2, "Encode mode must be 2 for alpha numeric");
    }

    public function testEncodeLatin1()
    {
        $qrgenerator = new QrCodeEncoding();
        $encodeMode = $qrgenerator->calculateEncodingMode("Café con leche - Málaga © 2024");
        assert($encodeMode === 4, "Encode mode must be 4 for latin 1");
    }
}
