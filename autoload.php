<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/src/class/$class.php";

    if (file_exists($file)) {
        require $file;
    }
});

spl_autoload_register(function ($class) {
    $file = __DIR__ . "/test/$class.php";

    if (file_exists($file)) {
        require $file;
    }
});

require_once __DIR__ . "/src/utils/utils.php";