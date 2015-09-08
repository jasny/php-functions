<?php

namespace Jasny;

/**
 * Get items from array.
 * 
 * @example list($foo, $bar, $useAll) = extract_keys($_GET, ['foo', 'bar', 'all' => false]);
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
        if (is_object($item)) {
            $item = clone $item;
            
            foreach ((array)$key as $k) {
                if (isset($item->$k)) unset($item->$k);
            }
        } elseif (is_array($item)) {
            foreach ((array)$key as $k) {
                if (isset($item[$k])) unset($item[$k]);
            }
        }
    }
}
