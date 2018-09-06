<?php

declare(strict_types = 1);

namespace Jasny;

/**
 * Return an array with only the specified keys.
 *
 * @param array          $array
 * @param string[]|int[] $keys
 * @return array
 */
function array_only(array $array, array $keys): array
{
    $intersect = array_fill_keys($keys, null);
    return array_intersect_key($array, $intersect);
}

/**
 * Return an array without the specified keys.
 *
 * @param array          $array
 * @param string[]|int[] $keys
 * @return array
 */
function array_without(array $array, array $keys): array
{
    $intersect = array_fill_keys($keys, null);
    return array_diff_key($array, $intersect);
}

/**
 * Check if an array contains all values in a set.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_all(array $array, array $subset, bool $strict = false)
{
    $contains = true;

    foreach ($subset as $value) {
        if (!in_array($value, $array, $strict)) {
            $contains = false;
            break;
        }
    }
    
    return $contains;
}

/**
 * Check if an array contains all values in a set with index check.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_all_assoc(array $array, array $subset, bool $strict = false): bool
{
    if (count(array_diff_key($subset, $array)) > 0) { // Quick test, just on keys
        return false;
    }

    $contains = true;

    foreach ($subset as $key => $value) {
        if (!array_key_exists($key, $array) ||
            isset($value) !== isset($array[$key]) ||
            ($strict ? $value !== $array[$key] : $value != $array[$key])
        ) {
            $contains = false;
        }
    }
    
    return $contains;
}

/**
 * Check if an array contains any value in a set.
 **
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_any(array $array, array $subset, bool $strict = false): bool
{
    $contains = false;

    foreach ($subset as $value) {
        if (in_array($value, $array, $strict)) {
            $contains = true;
            break;
        }
    }

    return $contains;
}

/**
 * Check if an array contains any value in a set with index check.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_any_assoc(array $array, array $subset, bool $strict = false): bool
{
    if (count(array_intersect_key($subset, $array)) === 0) { // Quick test, just on keys
        return false;
    }

    $contains = false;

    foreach ($subset as $key => $value) {
        if (array_key_exists($key, $array) &&
            isset($value) === isset($array[$key]) &&
            ($strict ? $value === $array[$key] : $value == $array[$key])
        ) {
            $contains = true;
            break;
        }
    }

    return $contains;
}


/**
 * Find an element of an array using a callback function.
 * @see array_filter()
 *
 * Returns the value or FALSE if no element was found.
     *
 * @param array    $array
 * @param callable $callback
 * @param int      $flag      Flag determining what arguments are sent to callback
 * @return mixed|false
 */
function array_find(array $array, callable $callback, int $flag = 0)
{
    foreach ($array as $key => $value) {
        $args = $flag === ARRAY_FILTER_USE_BOTH ? [$key, $value] :
            ($flag === ARRAY_FILTER_USE_KEY ? [$key] : [$value]);

        if ($callback(...$args)) {
            return $value;
        }
    }

    return false;
}

/**
 * Find a key of an array using a callback function.
 * @see array_filter()
 *
 * Returns the key or FALSE if no element was found.
 *
 * @param array    $array
 * @param callable $callback
 * @param int      $flag      Flag determining what arguments are sent to callback
 * @return string|int|false
 */
function array_find_key(array $array, callable $callback, int $flag = 0)
{
    foreach ($array as $key => $value) {
        $args = $flag === ARRAY_FILTER_USE_BOTH ? [$key, $value] :
            ($flag === ARRAY_FILTER_USE_KEY ? [$key] : [$value]);

        if ($callback(...$args)) {
            return $key;
        }
    }

    return false;
}


/**
 * Flatten a nested associative array, concatenating the keys.
 *
 * @param array  $array
 * @param string $glue
 * @return array
 */
function array_flatten(array $array, string $glue = '.'): array
{
    foreach ($array as $key => &$value) {
        if (!is_associative_array($value)) {
            continue;
        }

        unset($array[$key]);
        $value = array_flatten($value, $glue);

        foreach ($value as $subkey => $subvalue) {
            $array[$key . $glue . $subkey] = $subvalue;
        }
    }
    
    return $array;
}

/**
 * Join an array, using the 'and' parameter as glue the last two items.
 * 
 * @param string $glue
 * @param string $and
 * @param array  $array
 * @return string
 */
function array_join_pretty($glue, $and, array $array)
{
    $last = array_pop($array);
    
    return (empty($array) ? "" : join($glue, $array) . $and) . $last;
}
