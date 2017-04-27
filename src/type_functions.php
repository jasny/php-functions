<?php

namespace Jasny;

/**
 * Check if variable is an associative array.
 * 
 * @param array $var
 * @return boolean
 */
function is_associative_array($var)
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
 * @param array $var
 * @return boolean
 */
function is_numeric_array($var)
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
 * Check that an argument has a specific type, otherwise throw an exception.
 * 
 * @param mixed           $var
 * @param string|string[] $type
 * @param string          $throwable  Class name
 * @param string          $message
 * @throws \InvalidArgumentException
 */
function expect_type($var, $type, $throwable = 'TypeError', $message = null)
{
    $strTypes = [];
    $types = (array)$type;
    
    foreach ($types as $type) {
        $fn = $type === 'boolean' ? 'is_bool' : 'is_' . $type;
        $internal = function_exists($fn);
        
        if ($internal ? $fn($var) : is_a($var, $type)) {
            return; // Valid type
        }
        
        $strTypes[] = $type . ($internal ? '' : ' object');
    }
    
    if (!isset($message)) {
        $message = "Expected " . array_join_pretty(', ', ' or ', $strTypes) . ", %s given";
    }
    
    $varType = (is_object($var) ? get_class($var) . " " : "") . gettype($var);
    
    throw new $throwable(sprintf($message, $varType));
}
