Jasny's PHP functions
=====================

[![Build Status](https://travis-ci.org/jasny/php-functions.svg?branch=master)](https://travis-ci.org/jasny/php-functions)
[![Coverage Status](https://coveralls.io/repos/jasny/php-functions/badge.svg?branch=master&service=github)](https://coveralls.io/github/jasny/php-functions?branch=master)

A set of useful PHP functions.

## Installation

    composer require jasny\php-functins

## Array functions

#### array_column

    array array_column(array $input, mixed $columnKey[, mixed $indexKey]
    
This function is a polyfill for [`array_column()`](http://php.net/array_column) for PHP earlier than 5.5. Provided by
[ramsey/array_column](https://github.com/ramsey/array_column).

#### array_unset

    void array_unset(array &$array, string $key)

Walk through the array and unset an item with the key. Clones object, so the original aren't modified.

#### extract_keys

    array extract_keys(array $array, array $keys)

Get items from array identified by the keys. Will not trigger notices if a key doesn't exist.

`$keys` may be a mix of a index an assosiated array. With an indexed item, the value is used as key of `$array`. For an
associated item, the key is use as key of `$array` and the value is used as default. The default value is picked if
`$array` doesn't has the key or the value is `null` (using `isset()`).

###### Example

```php
list($foo, $bar, $useAll) = extract_keys($_GET, ['foo', 'bar', 'all' => false]);
```

## String functions

#### camelcase

    string camelcase(string $string, $ucfirst = true)

Turn a sentence, snake_case or kabab-case into **CamelCase**.

Set `$ucfirst` to false to start with a lower case character.

#### snakecase

    string snakecase(string $string)

Turn a sentence, CamelCase or kabab-case into **snake_case**.

#### kababcase

    string kababcase(string $string)

Turn a sentence, CamelCase or snake_case into **kabab-case**.


## Server functions

#### ip\_in\_cidr

    boolean ip_in_cidr($ip, $cidr)
    
Check if an IP is in a [CIDR](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) block.

