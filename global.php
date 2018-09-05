<?php

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
 * Check if an array contains any value in a set with index check.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_any_assoc(array $array, array $subset, $strict = false)
{
    return jasny\array_contains_any_assoc($array, $subset, $strict);
}

/**
 * Check if an array contains any value in a set.
 **
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_any(array $array, array $subset, $strict = false)
{
    return jasny\array_contains_any($array, $subset, $strict);
}

/**
 * Check if an array contains all values in a set with index check.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_all_assoc(array $array, array $subset, $strict = false)
{
    return jasny\array_contains_all_assoc($array, $subset, $strict);
}

/**
 * Check if an array contains all values in a set.
 *
 * @param array $array
 * @param array $subset
 * @param bool  $strict  Strict type checking
 * @return bool
 */
function array_contains_all(array $array, array $subset, $strict = false)
{
    return jasny\array_contains_all($array, $subset, $strict);
}

/**
 * Return an array without the specified keys.
 *
 * @param array          $array
 * @param string[]|int[] $keys
 * @return array
 */
function array_without(array $array, array $keys)
{
    return jasny\array_without($array, $keys);
}

/**
 * Return an array with only the specified keys.
 *
 * @param array          $array
 * @param string[]|int[] $keys
 * @return array
 */
function array_only(array $array, array $keys)
{
    return jasny\array_only($array, $keys);
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
 * Generate a URL friendly slug from the given string.
 *
 * @param string $string
 * @param string $glue
 * @return string
 */
function str_slug($string, $glue = '-')
{
    return jasny\str_slug($string, $glue);
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
 * Get the string after the first occurence of the substring.
 * If the substring is not found, an empty string is returned.
 *
 * @param string $string
 * @param string $substr
 * @return string
 */
function str_after($string, $substr)
{
    return jasny\str_after($string, $substr);
}

/**
 * Get the string before the first occurence of the substring.
 * If the substring is not found, the whole string is returned.
 *
 * @param string $string
 * @param string $substr
 * @return string
 */
function str_before($string, $substr)
{
    return jasny\str_before($string, $substr);
}

/**
 * Check if a string contains a substring
 *
 * @param string $string
 * @param string $substr
 * @return bool
 */
function str_contains($string, $substr)
{
    return jasny\str_contains($string, $substr);
}

/**
 * Check if a string ends with a substring
 *
 * @param string $string
 * @param string $substr
 * @return bool
 */
function str_ends_with($string, $substr)
{
    return jasny\str_ends_with($string, $substr);
}

/**
 * Check if a string starts with a substring
 *
 * @param string $string
 * @param string $substr
 * @return bool
 */
function str_starts_with($string, $substr)
{
    return jasny\str_starts_with($string, $substr);
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
 * Check if IPv6 address is in CIDR block
 *
 * @param string $ip
 * @param string $cidr
 * @return bool
 */
function ipv6_in_cidr($ip, $cidr)
{
    return jasny\ipv6_in_cidr($ip, $cidr);
}

/**
 * Check if IPv4 address is in CIDR block
 *
 * @param string $ip
 * @param string $cidr
 * @return bool
 */
function ipv4_in_cidr($ip, $cidr)
{
    return jasny\ipv4_in_cidr($ip, $cidr);
}

/**
 * Check if IP address is in CIDR block
 *
 * @param string $ip     An IPv4 or IPv6
 * @param string $cidr   An IPv4 CIDR block or IPv6 CIDR block
 * @return bool
 */
function ip_in_cidr($ip, $cidr)
{
    return jasny\ip_in_cidr($ip, $cidr);
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
 * Check that an argument has a specific type, otherwise throw an exception.
 * 
 * @param mixed           $var
 * @param string|string[] $type
 * @param string          $throwable  Class name
 * @param string          $message
 * @throws \InvalidArgumentException
 */
function expect_type($var, $type, $throwable = 'TypeError', $message = NULL)
{
    return jasny\expect_type($var, $type, $throwable, $message);
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
 * Check if variable is a numeric array.
 *
 * @param array $var
 * @return bool
 */
function is_numeric_array($var)
{
    return jasny\is_numeric_array($var);
}

/**
 * Check if variable is an associative array.
 *
 * @param array $var
 * @return bool
 */
function is_associative_array($var)
{
    return jasny\is_associative_array($var);
}

/**
 * Match path against an extended wildcard pattern.
 *
 * @param string $pattern
 * @param string $path
 * @return bool
 */
function fnmatch_extended($pattern, $path)
{
    return jasny\fnmatch_extended($pattern, $path);
}

/**
 * Check if the file contains the specified string
 *
 * @param string $filename
 * @param string $str
 * @return bool
 */
function file_contains($filename, $str)
{
    return jasny\file_contains($filename, $str);
}
