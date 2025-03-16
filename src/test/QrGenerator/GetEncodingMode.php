<?php

require_once __DIR__ . '/class/QrGenerator.php';

class GetEncodingMode
{

    public function test_encode_number()
    {
        $qrgenerator = new QrGenerator();
        $encode = $qrgenerator->getEncodingMode(1);
    }

}
