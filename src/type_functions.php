<?php

declare(strict_types = 1);

namespace Jasny;

/**
 * Check if variable is an associative array.
 *
 * @param array|mixed $var
 * @return bool
 */
function is_associative_array($var): bool
{
    if (!is_array($var)) {
        return false;
    }
    
    $keys = array_keys($var);
    return ($keys !== array_keys($keys));
}

/**
 * Check if variable is a numeric array.
 *
 * @param array|mixed $var
 * @return bool
 */
function is_numeric_array($var): bool
{
    if (!is_array($var)) {
        return false;
    }
    
    $keys = array_keys($var);
    return ($keys === array_keys($keys));
}

/**
 * Turn associated array into stdClass object recursively.
 *
 * @param array|mixed $var
 * @return \stdClass|mixed
 */
function objectify($var)
{
    $i = func_num_args() > 1 ? func_get_arg(1) : 100;
    
    if ($i <= 0) {
        throw new \OverflowException("Maximum recursion depth reached. Possible circular reference.");
    }
    
    if (!is_array($var) && !is_object($var)) {
        return $var;
    }
    
    if (is_associative_array($var)) {
        $var = (object)$var;
    }
    
    foreach ($var as &$value) {
        $value = objectify($value, $i - 1);
    }
    
    return $var;
}

/**
 * Turn stdClass object into associated array recursively.
 *
 * @param \stdClass|mixed $var
 * @return array|mixed
 */
function arrayify($var)
{
    $i = func_num_args() > 1 ? func_get_arg(1) : 100;
    
    if ($i <= 0) {
        throw new \OverflowException("Maximum recursion depth reached. Possible circular reference.");
    }
    
    if (!is_array($var) && !is_object($var)) {
        return $var;
    }
    
    if ($var instanceof \stdClass) {
        $var = (array)$var;
    }
    
    foreach ($var as &$value) {
        $value = arrayify($value, $i - 1);
    }
    
    return $var;
}

/**
 * Get the type of a variable in a descriptive way.
 *
 * @param mixed $var
 * @return string
 */
function get_type_description($var): string
{
    switch (gettype($var)) {
        case 'double':
            return 'float';
        case 'object':
            return get_class($var) . " object";
        case 'resource':
            return get_resource_type($var) . " resource";
        case 'unknown type':
            return "resource (closed)"; // BC PHP 7.1
        default:
            return gettype($var);
    }
}

/**
 * Check that an argument has a specific type, otherwise throw an exception.
 *
 * @param mixed           $var
 * @param string|string[] $type
 * @param string          $throwable  Class name
 * @param string          $message
 * @return void
 * @throws \InvalidArgumentException
 */
function expect_type($var, $type, string $throwable = \TypeError::class, string $message = null): void
{
    $strTypes = [];
    $types = is_scalar($type) ? [$type] : $type;

    foreach ($types as $curtype) {
        $fn = $curtype === 'boolean' ? 'is_bool' : 'is_' . $curtype;
        $internal = function_exists($fn);
        
        if ($internal ? $fn($var) : is_a($var, $curtype)) {
            return; // Valid type
        }
        
        $strTypes[] = $curtype . ($internal ? '' : ' object');
    }
    
    $message = $message ?: "Expected " . array_join_pretty(', ', ' or ', $strTypes) . ", %s given";
    $varType = get_type_description($var);

    throw new $throwable(sprintf($message, $varType));
}
