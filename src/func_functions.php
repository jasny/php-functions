<?php

declare(strict_types = 1);

namespace Jasny;

/**
 * Call a callback with named parameters as associative array.
 *
 * @param callable $callback
 * @param array    $params_arr
 * @return mixed
 * @throws \BadFunctionCallException
 * @throws \ReflectionException
 */
function call_user_func_assoc(callable $callback, array $params_arr)
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
            throw new \BadFunctionCallException("Missing argument '$key' for {$fn}()");
        }
    }
    
    return call_user_func_array($callback, array_slice($args, 0, $max));
}
