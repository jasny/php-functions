<?php

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
    return jasny\extract_keys($array, $keys);
}

/**
 * Walk through the array and unset an item with the key
 *
 * @param array        $array  Array with objects or arrays
 * @param string|array $key
 */
function array_unset(array $array, $key)
{
    return jasny\array_unset($array, $key);
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
    return jasny\array_only($array, $keys);
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
    return jasny\array_without($array, $keys);
}

/**
 * Check if a string starts with a substring
 *
 * @param string $string
 * @param string $substr
 * @return boolean
 */
function str_starts_with($string, $substr)
{
    return jasny\str_starts_with($string, $substr);
}

/**
 * Check if a string ends with a substring
 *
 * @param string $string
 * @param string $substr
 * @return boolean
 */
function str_ends_with($string, $substr)
{
    return jasny\str_ends_with($string, $substr);
}

/**
 * Check if a string contains a substring
 *
 * @param string $string
 * @param string $substr
 * @return boolean
 */
function str_contains($string, $substr)
{
    return jasny\str_contains($string, $substr);
}

/**
 * Replace characters with accents with normal characters.
 *
 * @param string $string
 * @return string
 */
function str_remove_accents($string)
{
    return jasny\str_remove_accents($string);
}

/**
 * Generate a URL friendly slug from the given string
 *
 * @param string $string
 * @return string
 */
function str_slug($string, $glue = '-')
{
    return jasny\str_slug($string, $glue);
}

/**
 * Check if IP address is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ip_in_cidr($ip, $cidr)
{
    return jasny\ip_in_cidr($ip, $cidr);
}

/**
 * Check if IPv4 address is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ipv4_in_cidr($ip, $cidr)
{
    return jasny\ipv4_in_cidr($ip, $cidr);
}

/**
 * Converts inet_pton output to string with bits
 *
 * @param string $inet
 * @return string
 */
function inet_to_bits($inet)
{
    return jasny\inet_to_bits($inet);
}

/**
 * Check if IPv6 address is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ipv6_in_cidr($ip, $cidr)
{
    return jasny\ipv6_in_cidr($ip, $cidr);
}

/**
 * Check if the file contains the specified string
 *
 * @string $filename
 * @string $str
 * @return boolean
 */
function file_contains($filename, $str)
{
    return jasny\file_contains($filename, $str);
}

/**
 * Turn a sentence, camelCase, snake_case or kabab-case into camelCase
 *
 * @param string $string
 * @return string
 */
function camelcase($string)
{
    return jasny\camelcase($string);
}

/**
 * Turn a sentence, camelCase, snake_case or kabab-case into StudlyCase
 *
 * @param string $string
 * @return string
 */
function studlycase($string)
{
    return jasny\studlycase($string);
}

/**
 * Turn a sentence, camelCase, StudlyCase or kabab-case into snake_case
 *
 * @param string $string
 * @return string
 */
function snakecase($string)
{
    return jasny\snakecase($string);
}

/**
 * Turn a sentence, camelCase, StudlyCase or snake_case into kabab-case
 *
 * @param string $string
 * @return string
 */
function kababcase($string)
{
    return jasny\kababcase($string);
}

/**
 * Turn StudlyCase, camelCase, snake_case or kabab-case into a sentence.
 *
 * @param string $string
 * @return string
 */
function uncase($string)
{
    return jasny\uncase($string);
}

/**
 * Get the value of a private or protected property
 * 
 * @param object $object
 * @param string $property
 * @return mixed
 */
function get_private_property($object, $property)
{
    return jasny\get_private_property($object, $property);
}

/**
 * Call a private or protected method
 * 
 * @param object $object
 * @param string $method
 * @param mixed  ...
 * @return mixed
 */
function call_private_method($object, $method)
{
    return jasny\call_private_method($object, $method);
}

/**
 * Call a private or protected method, giving the arguments as array
 * 
 * @param object $object
 * @param string $method
 * @param array  $args
 * @return mixed
 */
function call_private_method_array($object, $method, array $args)
{
    return jasny\call_private_method_array($object, $method, $args);
}
