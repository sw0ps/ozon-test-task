<?php

/**
 * Main function
 *
 * @param array $data
 * @return int
 */
function maxOnesAfterRemoveItem(array $data): int
{
    // Check the validity of input data
    if (!isValidData($data)) {
        return 0;
    }

    $maxCountValue = 0;
    $mainCounter = 0;
    $additionalCounter = 0;
    $zeroCounter = 0;

    for ($i = 0; $i < count($data); $i++) {

        if ($data[$i] === 1) {
            incrementValue($mainCounter);
            resetValue($zeroCounter);
            continue;
        }

        calculateMaxCountValueByCounters($maxCountValue, $mainCounter, $additionalCounter);
        processingMainAndAdditionalCounters($mainCounter, $additionalCounter);
        incrementValue($zeroCounter);

        if (checkZeroCounter($zeroCounter)) {
            resetValues($mainCounter, $additionalCounter, $zeroCounter);
        }
    }

    calculateMaxCountValueByCounters($maxCountValue, $mainCounter, $additionalCounter);
    calculateMaxCountValueByDataLength($maxCountValue, $data);

    return $maxCountValue;
}

// Functions and procedures for hide some abstractions

/**
 * @param array $data
 * @return bool
 */
function isValidData(array $data): bool
{
    return !empty($data);
}

/**
 * @param int $maxCountValue
 * @param int $mainCounter
 * @param int $additionalCounter
 */
function calculateMaxCountValueByCounters(int &$maxCountValue, int $mainCounter, int $additionalCounter): void
{
    $sum = $mainCounter + $additionalCounter;
    if ($sum > $maxCountValue) {
        $maxCountValue = $sum;
    }
}

/**
 * @param int $maxCountValue
 * @param array $data
 */
function calculateMaxCountValueByDataLength(int &$maxCountValue, array $data): void
{
    if ($maxCountValue >= count($data)) {
        $maxCountValue -= 1;
    }
}

/**
 * @param int $zeroCounter
 * @return bool
 */
function checkZeroCounter(int $zeroCounter): bool
{
    return $zeroCounter > 1;
}

/**
 * @param int ...$values
 */
function resetValues(int ...$values): void
{
    foreach ($values as $value) {
        resetValue($value);
    }
}

/**
 * @param int $mainCounter
 * @param int $additionalCounter
 */
function processingMainAndAdditionalCounters(int &$mainCounter, int &$additionalCounter): void
{
    $additionalCounter = $mainCounter;
    $mainCounter = 0;
}

/**
 * @param int $value
 */
function resetValue(int &$value)
{
    $value = 0;
}

/**
 * @param int $value
 */
function incrementValue(int &$value)
{
    $value += 1;
}
