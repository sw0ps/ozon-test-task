<?php

require_once __DIR__ . "/maxOnesAfterRemoveItem.php";
require_once __DIR__ . "/helper.php";


/**
 * Functions arguments and expected value
 */
const testCases = [
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
        array_push($errors, "!!! Error: Call func with params [" . arrayToString($params) . "] has result " . $result . " not equal to expected value ". $expected);
    }
}

function arrayToString(array $arr): string
{
    return implode(", ", $arr);
}

/**
 * Run for test main function
 */
function runTest(): void
{
    $errors = [];

    foreach (testCases as [$params, $expected]) {
        assertEqual(maxOnesAfterRemoveItem($params), $params, $expected, $errors);
    }

    processingErrorsList($errors);
}

/**
 * @param array $errors
 */
function processingErrorsList(array $errors): void
{
    if (empty($errors)) {
        println("SUCCESS!");
        return;
    }

    foreach ($errors as $error) {
        println($error);
    }
}
