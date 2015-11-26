<?php

namespace Jasny;

/**
 * Get the value of a private or protected property
 * 
 * @param object $object
 * @param string $property
 * @return mixed
 */
function get_private_property($object, $property)
{
    $reflObj = is_object($object) ?
        new \ReflectionObject($object) :
        new \ReflectionClass($object);

    $reflProp = $reflObj->getProperty($property);
    $reflProp->setAccessible(true);

    return $reflProp->getValue(is_object($object) ? $object : null);
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
    $args = array_slice(func_get_args(), 2);
    return call_private_method_array($object, $method, $args);
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
    $reflObj = is_object($object) ?
        new \ReflectionObject($object) :
        new \ReflectionClass($object);

    $reflMethod = $reflObj->getMethod($method);
    $reflMethod->setAccessible(true);

    return $reflMethod->invokeArgs(is_object($object) ? $object : null, $args);
}
