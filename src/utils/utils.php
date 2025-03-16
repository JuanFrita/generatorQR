<?php

#Log utils

function log_info(string $info)
{
    echo "\e[32m$info\e[0m\n"; // Verde
}

function log_error(string $error)
{
    echo "\e[31m$error\e[0m\n";
}
