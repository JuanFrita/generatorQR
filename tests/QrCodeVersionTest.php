<?php

namespace Juanfrita\QrGenerator\Tests;

use Juanfrita\QrGenerator\Core\QrCodeVersion;

class QrCodeVersionTest
{
    #TEST OPTIMAL VERSION
    public function testOptimalVersion()
    {
        $qrGenerator = new QrCodeVersion();
        $version = $qrGenerator->calculateOptimalVersion(23, 4);
        assert($version === 2, "Version should be 2 for LATIN 1 and 23 chars");
    }
}
