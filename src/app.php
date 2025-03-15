<?php

require_once __DIR__ . '/class/CodeGenerator.php';

#Simple PHP script to output codeGenerator results

$codeGenerator = new CodeGenerator();

echo $codeGenerator->generate() . "\n";
