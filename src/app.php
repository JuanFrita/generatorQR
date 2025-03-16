<?php

require_once __DIR__ . '/class/QrGenerator.php';

#Simple PHP script to output codeGenerator results

$codeGenerator = new QrGenerator();

echo $codeGenerator->generate("https://www.qrcode.com/") . "\n";
