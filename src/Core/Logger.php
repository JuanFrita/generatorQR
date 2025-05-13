<?php

namespace Juanfrita\QrGenerator\Core;

class Logger
{
    public function info(string $info): void
    {
        echo $this->green($info) . "\n";
    }

    public function error(string $error): void
    {
        echo $this->red($error) . "\n";
    }

    public function red(string $msg): string
    {
        return "\e[31m$msg\e[0m";
    }

    public function green(string $msg): string
    {
        return "\e[32m$msg\e[0m";
    }
}
