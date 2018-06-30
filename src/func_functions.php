<?php

namespace Jasny;

/**
 * Call a callback with named parameters as associative array.
 *
 * @param callable $callback
 * @param array    $params_arr
 * @return mixed
 * @throws RuntimeException
 */
function call_user_func_assoc($callback, array $params_arr)
{
    $refl = is_array($callback)
        ? new \ReflectionMethod($callback[0], $callback[1])
        : new \ReflectionFunction($callback);
    
    $args = [];
    $max = 0;
    $params = $refl->getParameters();

    foreach ($params as $i => $param) {
        $key = $param->name;
        
        if (array_key_exists($key, $params_arr)) {
            $args[] = $params_arr[$key];
            $max = $i + 1;
        } elseif ($param->isOptional()) {
            $args[] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
        } else {
            $fn = $refl instanceof \ReflectionMethod ? $refl->class . '::' . $refl->name : $refl->name;
            throw new \RuntimeException("Missing argument '$key' for {$fn}()");
        }
    }
    
    return call_user_func_array($callback, array_slice($args, 0, $max));
}

/**
 * Alias of call_user_func_assoc
 * @deprecated
 *
 * @param callable $callback
 * @param array    $params_arr
 * @return mixed
 * @throws RuntimeException
 */
function call_user_func_named_array($callback, array $params_arr)
{
    return call_user_func_assoc($callback, $params_arr);
}
