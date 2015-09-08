<?php

namespace Jasny;

/**
 * Turn a sentence, snake_case or kabab-case into CamelCase
 * 
 * @param string  $string
 * @param boolean $ucfirst
 * @return string
 */
function camelcase($string, $ucfirst = true)
{
    $sentence = preg_replace('/[\W_]+/', ' ', $string);
    $camel = str_replace(' ', '', ucwords($sentence));
    
    if (!$ucfirst) $camel = lcfirst($camel);
    
    return $camel;
}

/**
 * Turn a sentence, CamelCase or kabab-case into snake_case
 * 
 * @param string  $string
 * @return string
 */
function snakecase($string)
{
    $sentence = strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $string));
    return preg_replace('/[\W\_]+/', '_', $sentence);
}

/**
 * Turn a sentence, CamelCase or snake_case into kabab-case
 * 
 * @param string  $string
 * @return string
 */
function kababcase($string)
{
    $sentence = strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $string));
    return preg_replace('/[\W\_]+/', '-', $sentence);
}

