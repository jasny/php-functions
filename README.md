Jasny's PHP functions
=====================

[![Build Status](https://travis-ci.org/jasny/php-functions.svg?branch=master)](https://travis-ci.org/jasny/php-functions)
[![Code Coverage](https://scrutinizer-ci.com/g/jasny/php-functions/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jasny/php-functions/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jasny/php-functions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jasny/php-functions/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/79f3ee18-e8fc-4c7f-8b97-35d04c47a65c/mini.png)](https://insight.sensiolabs.com/projects/79f3ee18-e8fc-4c7f-8b97-35d04c47a65c)

A set of useful PHP functions.

**All functions are in the `Jasny` namespace.**

```php
use function Jasny\str_contains; // Import functions

str_contains('moonrise', 'on');
Jasny\slug('Foo bár'); // or use directly
```

## Installation

    composer require jasny\php-functions

## Array functions

#### array_unset

    array_unset(array &$array, string $key)

Walk through the array and unset an item with the key. Clones object, so the original aren't modified.

#### array_only

    array array_only(array $array, string $key)

Return an array with only the specified keys.

#### array_without

    array array_without(array $array, string $key)

Return an array without the specified keys.

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

#### str_starts_with

    boolean str_starts_with(string $string, $string $substr)
    
Check if a string starts with a substring.

#### str_ends_with

    boolean str_ends_with(string $string, string $substr)

Check if a string ends with a substring.

#### str_contains

    boolean str_contains(string $string, string $substr)
    
Check if a string contains a substring.

#### str_remove_accents

    string str_remove_accents(string $string)
    
Replace characters with accents with normal characters.

#### str_slug

    string str_slug(string $string, string $glue = '-')
    
Generate a URL friendly slug from the given string.


## Cast functions

#### camelcase

    string camelcase(string $string)

Turn a sentence, StudlyCase, snake_case or kabab-case into **camelCase**.

#### studlycase

    string studlycase(string $string, $ucfirst = true)

Turn a sentence, camelCase, snake_case or kabab-case into **StudlyCase**.

#### snakecase

    string snakecase(string $string)

Turn a sentence, StudlyCase, camelCase or kabab-case into **snake_case**.

#### kababcase

    string kababcase(string $string)

Turn a sentence, StudlyCase, camelCase or snake_case into **kabab-case**.

#### uncase

    string uncase(string $string)

Turn StudlyCase, camelCase, snake_case or kabab-case into a **sentence**.


## Server functions

#### ip\_in\_cidr

    boolean ip_in_cidr(string $ip, string $cidr)
    
Check if an IP is in a [CIDR](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) block.


## File functions

#### file_contains

    boolean file_contains(string $filename, string $string)
    
Check if a string is present in the contents of a file.

This function is memory usage friendly by not loading the whole contents of the file at once.

#### fnmatch

    fnmatch(string $pattern, string $path)
    
Match path against wildcard pattern. This is an extended version of [fnmatch](http://php.net/fnmatch).

* `?` Matches a single character, except `/`
* `#` Matches any decimal characters (0-9)
* `*` Matches any characters, except `/`
* `**` Matches any characters
* `[abc]` Matches `a`, `b` or `c`
* `{a,b,c}` Matches `a`, `b` or `c`

