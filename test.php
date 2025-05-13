<?php

require_once __DIR__ . "/vendor/autoload.php";

use Juanfrita\QrGenerator\Class\Logger;

$class = $argv[1] ?? null;

$logger = new Logger();

echo "\n";

try {
    if ($class) {
        $testClasses = [$class];
    } else {
        $classes = scandir("./tests");

        $testClasses = array_filter($classes, function ($class) {
            return str_ends_with($class, "Test.php");
        });

        $testClasses = array_map(function ($class) {
            return str_replace(".php", "", $class);
        }, $testClasses);
    }

    if ($testClasses === []) {
        echo "No test classes found\n\n";
        exit;
    }

    foreach ($testClasses as $testClass) {
        $errors[] = testClass($testClass);
    }

    $errors = array_merge([], ...$errors);

    if ($errors !== []) {
        $logger->error("\n\nSome tests failed.\n");
        foreach ($errors as $e) {
            echo $logger->red($e) . "\n\n";
        }
    } else {
        $logger->info("\n\nAll tests passed");
    }

    echo "\n";

    exit;
} catch (Throwable $th) {
    $logger->error($th->getMessage());
}

function testClass(string $class): array
{
    global $logger;

    $class = "Juanfrita\\QrGenerator\\Tests\\$class";

    $obj = new $class();

    $funcs = get_class_methods($obj);

    $tests = array_filter($funcs, function ($func) {
        return str_starts_with($func, "test");
    });

    if ($tests === []) {
        throw new Exception("No tests in $class");
    }

    $errors = [];

    foreach ($tests as $index => $test) {
        try {
            $obj->$test();
        } catch (Throwable $e) {
            $errors[] = "$class Test::$index $test failed: " . $e->getMessage();
            echo $logger->red("F");
            continue;
        }
        echo ".";
    }

    return $errors;
}
