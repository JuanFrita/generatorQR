<?php

require "autoload.php";

$class = $argv[1] ?? null;

try {

    if ($class) {
        $testClasses = [$class];
    } else {
        $classes = scandir("./test");

        $testClasses = array_filter($classes, function ($class) {
            return str_ends_with($class, "Test.php");
        });

        $testClasses = array_map(function ($class) {
            return str_replace(".php", "", $class);
        }, $testClasses);
    }

    foreach ($testClasses as $testClass) {
        testClass($testClass);
    }

} catch (\Throwable $th) {
    logError($th->getMessage());
}

function testClass(string $class)
{
    echo  "\nTesting class $class \n\n";

    $obj = new $class();

    $funcs = get_class_methods($obj);

    $tests = array_filter($funcs, function ($func) {
        return str_starts_with($func, "test");
    });

    if ($tests === []) {
        throw new Exception("No tests in $class");
    }

    $failed = false;

    foreach ($tests as $index => $test) {
        try {
            $obj->$test();
        } catch (Throwable $e) {
            $failed = true;
            logError("Test::$index $test failed: " . $e->getMessage() . "\n");
            continue;
        }
    }

    if ($failed) {
        logError("Some tests failed for $class.\n");
    } else {
        logInfo("All tests passed for $class.\n");
    }
}
