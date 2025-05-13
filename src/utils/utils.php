<?php

#Log utils

function logInfo(string $info)
{
    echo "\e[32m$info\e[0m\n"; // Verde
}

function logError(string $error)
{
    echo "\e[31m$error\e[0m\n";
}
