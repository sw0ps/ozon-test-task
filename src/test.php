<?php

require_once __DIR__ . "/maxOnesAfterRemoveItem.php";
require_once __DIR__ . "/helper.php";
require_once __DIR__ . "/benchmark.php";

/**
 * Functions arguments and expected value
 */
const TEST_CASES = [
    [[0, 0], 0],
    [[0, 1], 1],
    [[1, 0], 1],
    [[1, 1], 1],
    [[1, 1, 0, 1, 1], 4],
    [[1, 1, 0, 1, 1, 0, 1, 1, 1], 5],
    [[1, 1, 0, 1, 1, 0, 1, 1, 1, 0], 5]
];
//
// Logic for test
//

/**
 * @param int $result
 * @param int $expected
 * @param array $errors
 */
function assertResult(int $result, int $expected, array &$errors)
{
    if ($result != $expected) {
        array_push($errors, "!!! Error in the received result - " . $result . "; expected - " . $expected);
    }
}

/**
 * @param int $result
 * @param array $params
 * @param int $expected
 * @param array $errors
 */
function assertEqual(int $result, array $params, int $expected, array &$errors): void
{
    if ($result !== $expected) {
        array_push($errors, "!!! Error: Call func with params [" . arrayToString($params) . "] has result " . $result . " not equal to expected value " . $expected);
    }
}

/**
 * @param array $arr
 * @return string
 */
function arrayToString(array $arr): string
{
    return implode(", ", $arr);
}

/**
 * @param string $func
 * @param array $params
 * @return int
 */
function useBenchmark(string $func, array $params): int
{
    if (!hasBenchmark()) {
        return $func($params);
    }

    return benchmark($func, $params);
}

/**
 * @return bool
 */
function hasBenchmark(): bool
{
    return function_exists("benchmark");
}

/**
 * Run for test main function
 */
function runTest(): void
{
    $errors = [];

    if (hasBenchmark()) {
        println("----------------------------------");
        println("Script execution time:\n");
    }

    foreach (TEST_CASES as [$params, $expected]) {

        assertEqual(
            useBenchmark("maxOnesAfterRemoveItem", $params),       // check bench end return result
            $params,
            $expected,
            $errors);
    }

    processingErrorsList($errors);
}

/**
 * @param array $errors
 */
function processingErrorsList(array $errors): void
{
    println("----------------------------------");
    println("Result:\n");
    if (empty($errors)) {
        println("SUCCESS!");
        println("All tests passed successfully!");
        return;
    }

    foreach ($errors as $error) {
        println($error);
    }

    println("\tThe " . count($errors) . " out of " . count(TEST_CASES) . " tests  - FAILED!");
}
