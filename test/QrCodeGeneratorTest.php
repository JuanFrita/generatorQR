<?php

require "autoload.php";

class QrCodeGeneratorTest
{
    public function test_encode_number()
    {
        $qrgenerator = new QrGenerator();
        $encodeMode = $qrgenerator->getEncodingMode(1);
        assert($encodeMode === 1, "Encode mode must be 1 for digits");
    }

    public function test_encode_alphaNumeric()
    {
        $qrgenerator = new QrGenerator();
        $encodeMode = $qrgenerator->getEncodingMode("ABC123ZXY");
        assert($encodeMode === 2, "Encode mode must be 2 for alpha numeric");
    }

    public function test_encode_latin1()
    {
        $qrgenerator = new QrGenerator();
        $encodeMode = $qrgenerator->getEncodingMode("Café con leche - Málaga © 2024");
        assert($encodeMode === 4, "Encode mode must be 4 for latin 1");
    }
}
