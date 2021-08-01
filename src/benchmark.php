<?php

/**
 * @param string $callback
 * @param mixed $params
 * @return mixed
 */
function benchmark(string $callback, $params)
{
    if (!function_exists($callback)) {
        println ("!!! Function " . $callback . " doesn't exist.");
        return 0;
    }

    return checkTimeExecution($callback, $params);
}

/**
 * @param string $callback
 * @param mixed $params
 * @return mixed
 */
function checkTimeExecution(string $callback, $params)
{
    $time = microtime(true) * 1000;
    $funcResult = $callback($params);
    $time = (microtime(true) * 1000) - $time;

    println ("Script execution time: " . round($time, 5) . " milliseconds.");

    return $funcResult;
}
