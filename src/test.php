<?php

require_once __DIR__ . "/maxOnesAfterRemoveItem.php";
require_once __DIR__ . "/helper.php";

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
 * Run for test main function
 */
function runTest(): void
{
    $errors = [];

    assertResult(maxOnesAfterRemoveItem([0, 0]), 0, $errors);
    assertResult(maxOnesAfterRemoveItem([0, 1]), 1, $errors);
    assertResult(maxOnesAfterRemoveItem([1, 0]), 1, $errors);
    assertResult(maxOnesAfterRemoveItem([1, 1]), 1, $errors);
    assertResult(maxOnesAfterRemoveItem([1, 1, 0, 1, 1]), 4, $errors);
    assertResult(maxOnesAfterRemoveItem([1, 1, 0, 1, 1, 0, 1, 1, 1]), 5, $errors);
    assertResult(maxOnesAfterRemoveItem([1, 1, 0, 1, 1, 0, 1, 1, 1, 0]), 5, $errors);

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

    foreach ($errors as $key => $error) {
        println($key . " - " . $error);
    }
}
