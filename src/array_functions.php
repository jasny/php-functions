<?php

namespace Jasny;

/**
 * Get items from an array.
 * Set default values using [key => value].
 *
 * <code>
 *   list($foo, $bar, $useAll) = extract_keys($_GET, ['foo', 'bar', 'all' => false]);
 * </cody>
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function extract_keys(array $array, array $keys)
{
    $values = [];

    foreach ($keys as $i => $v) {
        $key = is_int($i) ? $v : $i;
        $default = is_int($i) ? null : $v;
        
        $values[] = isset($array[$key]) ? $array[$key] : $default;
    }

    return $values;
}

/**
 * Walk through the array and unset an item with the key
 *
 * @param array        $array  Array with objects or arrays
 * @param string|array $key
 */
function array_unset(array &$array, $key)
{
    foreach ($array as &$item) {
        foreach ((array)$key as $k) {
            if (is_object($item) && isset($item->$k)) {
                unset($item->$k);
            }

            if (is_array($item) && isset($item[$k])) {
                unset($item[$k]);
            }
        }
    }
}

/**
 * Return an array with only the specified keys.
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function array_only(array $array, array $keys)
{
    $intersect = array_fill_keys($keys, null);
    return array_intersect_key($array, $intersect);
}

/**
 * Return an array without the specified keys.
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function array_without(array $array, array $keys)
{
    $intersect = array_fill_keys($keys, null);
    return array_diff_key($array, $intersect);
}

/**
 * Check if an array contains a set of values.
 * 
 * @param array   $array
 * @param array   $subset
 * @param boolean $strict  Strict type checking
 * @return boolean
 */
function array_contains(array $array, array $subset, $strict = false)
{
    foreach ($subset as $value) {
        if (!in_array($value, $array, $strict)) {
            return false;
        }
    }
    
    return true;
}

/**
 * Check if an array contains a set of values with index check.
 * 
 * @param array $array
 * @param array $subset
 * @param boolean $strict  Strict type checking
 * @return boolean
 */
function array_contains_assoc(array $array, array $subset, $strict = false)
{
    foreach ($subset as $key => $value) {
        if (
            !array_key_exists($key, $array) ||
            isset($value) !== isset($array[$key]) ||
            ($strict ? $value !== $array[$key] : $value != $array[$key])
        ) {
            return false;
        }
    }
    
    return true;
}

/**
 * Flatten a nested associative array, concatenating the keys.
 * 
 * @param array  $array
 * @param string $glue
 * @return array
 */
function array_flatten(array $array, $glue = '.')
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

