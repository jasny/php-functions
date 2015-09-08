<?php

namespace Jasny;

/**
 * Turn a sentence, camelCase, snake_case or kabab-case into camelCase
 * 
 * @param string $string
 * @return string
 */
function camelcase($string)
{
    $sentence = preg_replace('/[\W_]+/', ' ', $string);
    return lcfirst(str_replace(' ', '', ucwords($sentence)));
}

/**
 * Turn a sentence, camelCase, snake_case or kabab-case into StudlyCase
 * 
 * @param string $string
 * @return string
 */
function studlycase($string)
{
    $sentence = preg_replace('/[\W_]+/', ' ', $string);
    return str_replace(' ', '', ucwords($sentence));
}

/**
 * Turn a sentence, camelCase, StudlyCase or kabab-case into snake_case
 * 
 * @param string $string
 * @return string
 */
function snakecase($string)
{
    $sentence = strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $string));
    return preg_replace('/[\W\_]+/', '_', $sentence);
}

/**
 * Turn a sentence, camelCase, StudlyCase or snake_case into kabab-case
 * 
 * @param string $string
 * @return string
 */
function kababcase($string)
{
    $sentence = strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $string));
    return preg_replace('/[\W\_]+/', '-', $sentence);
}

/**
 * Turn StudlyCase, camelCase, snake_case or kabab-case into a sentence.
 *
 * @param string $string
 * @return string
 */
function uncase($string)
{
    $snake = strtolower(preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $string));
    $sentence = preg_replace('/[-_\s]+/', ' ', $snake);
    if (ctype_upper($string[0])) $sentence = ucfirst($sentence);
    
    return $sentence;
}

