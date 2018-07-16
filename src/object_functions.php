<?php

namespace Jasny;

/**
 * Get the public properties of an object.
 * This is an alias of `get_object_vars`, except if will always return public properties only.
 *
 * @param object $object
 * @param bool   $dynamic  Get properties not defined in the class
 * @return array
 */
function object_get_properties($object, $dynamic = false)
{
    $data = get_object_vars($object);

    if (!$dynamic) {
        $class = get_class($object);
        $props = array_keys(get_class_vars($class));

        $data = array_only($data, $props);
    }

    return $data;
}

/**
 * Set the public properties of an object
 *
 * @param object $object
 * @param array  $data
 * @param bool   $dynamic  Set properties not defined in the class
 */
function object_set_properties($object, array $data, $dynamic = false)
{
    if (!$dynamic) {
        $class = get_class($object);
        $props = array_keys(get_class_vars($class));

        $data = array_only($data, $props);
    }

    foreach ($data as $key => $value) {
        $object->$key = $value;
    }
}
