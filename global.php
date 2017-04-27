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
 * Check if an array contains a set of values.
 * 
 * @param array   $array
 * @param array   $subset
 * @param boolean $strict  Strict type checking
 * @return boolean
 */
function array_contains(array $array, array $subset, $strict = false)
{
    return jasny\array_contains($array, $subset, $strict);
}

/**
 * Check if an array contains a set of values with index check.
 * 
 * @param array $array
 * @param array $subset
 * @param boolean $strict  Strict type checking
 * @return boolean
 */
function array_has_subset(array $array, array $subset, $strict = false)
{
    return jasny\array_has_subset($array, $subset, $strict);
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
    return jasny\array_flatten($array, $glue);
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
    return jasny\array_join_pretty($glue, $and, $array);
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
 * Convert an IPv4 address or CIDR into an IP6 address or CIDR.
 * 
 * @param string $ip
 * @return string
 * @throws \InvalidArgumentException if ip isn't valid
 */
function ipv4_to_ipv6($ip)
{
    return jasny\ipv4_to_ipv6($ip);
}

/**
 * Check if IP address is in CIDR block
 * 
 * @param string $ip     An IPv4 or IPv6
 * @param string $cidr   An IPv4 CIDR block or IPv6 CIDR block
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
 * Converts inet_pton output to string with bits.
 *
 * @param string $inet
 * @return string
 */
function inet_to_bits($inet)
{
    return jasny\inet_to_bits($inet);
}

/**
 * Check if variable is an associative array.
 * 
 * @param array $var
 * @return boolean
 */
function is_associative_array($var)
{
    return jasny\is_associative_array($var);
}

/**
 * Check if variable is a numeric array.
 * 
 * @param array $var
 * @return boolean
 */
function is_numeric_array($var)
{
    return jasny\is_numeric_array($var);
}

/**
 * Turn associated array into stdClass object recursively.
 * 
 * @param array|mixed $var
 * @return \stdClass|mixed
 */
function objectify($var)
{
    return jasny\objectify($var);
}

/**
 * Turn stdClass object into associated array recursively.
 * 
 * @param \stdClass|mixed $var
 * @return array|mixed
 */
function arrayify($var)
{
    return jasny\arrayify($var);
}

/**
 * Check that an argument has a specific type, otherwise throw an exception.
 * 
 * @param mixed           $var
 * @param string|string[] $type
 * @param string          $throwable  Class name (defaults to Throwable in PHP7, InvalidArgumentException in PHP5)
 * @param string          $message
 * @throws \InvalidArgumentException
 */
function expect_type($var, $type, $throwable = NULL, $message = NULL)
{
    return jasny\expect_type($var, $type, $throwable, $message);
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
 * Match path against an extended wildcard pattern.
 *
 * @param string $pattern
 * @param string $path
 * @return boolean
 */
function fnmatch_extended($pattern, $path)
{
    return jasny\fnmatch_extended($pattern, $path);
}
