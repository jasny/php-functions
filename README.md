Jasny's PHP functions
=====================

[![Build Status](https://travis-ci.org/jasny/php-functions.svg?branch=master)](https://travis-ci.org/jasny/php-functions)
[![Code Coverage](https://scrutinizer-ci.com/g/jasny/php-functions/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/jasny/php-functions/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jasny/php-functions/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jasny/php-functions/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/79f3ee18-e8fc-4c7f-8b97-35d04c47a65c/mini.png)](https://insight.sensiolabs.com/projects/79f3ee18-e8fc-4c7f-8b97-35d04c47a65c)
[![Packagist Stable Version](https://img.shields.io/packagist/v/jasny/php-functions.svg)](https://packagist.org/packages/jasny/php-functions)
[![Packagist License](https://img.shields.io/packagist/l/jasny/php-functions.svg)](https://packagist.org/packages/jasny/php-functions)

A set PHP functions that _should_ have been part of PHP's core libraries.

**Example**

```php
$found = str_contains($string, 'foo') && array_contains($array, ['all', 'of', 'these']);
// VS
$found = strpos($string, 'foo') !== false && count(array_intersect($array, ['all', 'of', 'these'])) === 3;
```

## Installation

    composer require jasny\php-functions

## Usage

**All functions are in the `Jasny` namespace.**

```php
use function Jasny\str_contains; // Import functions

str_contains('moonrise', 'on');

Jasny\slug('Foo bár'); // or use directly
```

To import all the functions to the global namespace require 'global.php' anywhere in your application.

```php
require_once 'vendor/jasny/php-functions/global.php';
```

Alternatively, add it to the `autoload` section of `composer.json`.

```
"autoload": {
    "files": [
        "vendor/jasny/php-functions/global.php"
    ]
}
```

## Type functions

#### is\_associative\_array

    boolean is_associative_array(mixed $var)

Check if variable is an associative array.

#### is\_numeric\_array

    boolean is_numeric_array(mixed $var)

Check if variable is a numeric array.

#### objectify

    stdClass|mixed objectify(array|mixed $var)

Turn an associated array into a `stdClass` object recursively.

#### arrayify

    array|mixed arrayify(stdClass|mixed $var)

Turn an `stdClass` object into an associated array recursively.

#### expect\_type

    expect_type(mixed $var, string|string[] $type, string $throwable = null, string $message = null)
    
Validate that an argument has a specific type. 

By default a `TypeError` (PHP 7) is thrown. You can specify a class name for any `Throwable` class. For PHP 5 you must
specify the class name.

The message may contain a `%s`, which is replaced by the type of `$var`.

###### Example

```php
expect_type($input, ['array', 'stdClass']);
expect_type($output, ['array', 'stdClass'], 'UnexpectedValueException', "Output should be an array or stdClass object, got a %s");
```

## Array functions

#### array\_only

    array array_only(array $array, array $keys)

Return an array with only the specified keys.

#### array\_without

    array array_without(array $array, array $keys)

Return an array without the specified keys.

#### array\_contains\_all

    boolean array_contains_all(array $array, array $subset, boolean $strict = false)

Check if an array contains all values in a set.

_This function works as expected with nested arrays or an array with objects._

#### array\_contains\_all\_assoc

    boolean array_contains_all_assoc(array $array, array $subset, boolean $strict = false)

Check if an array contains all values in a set with index check.

_This function works as expected with nested arrays or an array with objects._

#### array\_contains\_any

    boolean array_contains_any(array $array, array $subset, boolean $strict = false)

Check if an array contains any value in a set.

_This function works as expected with nested arrays or an array with objects._

#### array\_contains\_any\_assoc

    boolean array_contains_any_assoc(array $array, array $subset, boolean $strict = false)

Check if an array contains any value in a set with index check.

_This function works as expected with nested arrays or an array with objects._

#### array\_flatten

    array function array_flatten(string $glue, array $array)

Flatten a nested associative array, concatenating the keys.

###### Example

```php
$values = array_flatten('.', [
    'animal' => [
        'mammel' => [
            'ape',
            'bear'
        ],
        'reptile' => 'chameleon'
    ],
    'colors' => [
        'red' => 60,
        'green' => 100,
        'blue' => 0
    ]
]);
```

Will become

```php
[
    'animal.mammel' => [
        'ape',
        'bear'
    ],
    'animal.reptile' => 'chameleon',
    'colors.red' => 60,
    'colors.green' => 100,
    'colors.blue' => 0
]
```

#### array\_join\_pretty

    string array_join_pretty(string $glue, string $and, array $array);

Join an array, using the 'and' parameter as glue the last two items.

###### Example

```php
echo "A task to " . array_join_pretty(", ", " and ", $chores) . " has been created.", PHP_EOL;
echo array_join_pretty(", ", " or ", $names) . " may pick up this task.", PHP_EOL;
```


## String functions

#### str\_starts\_with

    boolean str_starts_with(string $string, $string $substr)
    
Check if a string starts with a substring.

#### str\_ends\_with

    boolean str_ends_with(string $string, string $substr)

Check if a string ends with a substring.

#### str\_contains

    boolean str_contains(string $string, string $substr)
    
Check if a string contains a substring.

#### str\_before

    string str_before(string $string, string $substr)

Get a string before the first occurence of the substring. If the substring is not found, the whole string is returned.

#### str\_after

    string str_after(string $string, string $substr)

Get a string after the first occurence of the substring. If the substring is not found, an empty string is returned.

#### str\_remove\_accents

    string str_remove_accents(string $string)
    
Replace characters with accents with normal characters.

#### str\_slug

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

Turn StudlyCase, camelCase, snake_case or kabab-case into **a sentence**.


## Server functions

#### ip\_in\_cidr

    boolean ip_in_cidr(string $ip, string $cidr)
    
Check if an IP address is in a [CIDR](https://en.wikipedia.org/wiki/Classless_Inter-Domain_Routing) block.

_Works with IPv4 and IPv6._

#### ipv4\_in\_cidr

    boolean ipv4_in_cidr(string $ip, string $cidr)

Check if an IPv4 address is in a CIDR block.

#### ipv6\_in\_cidr

    boolean ipv6_in_cidr(string $ip, string $cidr)

Check if an IPv6 address is in a CIDR block.

#### inet\_to\_bits

    string inet_to_bits(string $inet)

Converts inet_pton output to string with bits.

## File functions

#### file\_contains

    boolean file_contains(string $filename, string $string)
    
Check if a string is present in the contents of a file.

This function is memory usage friendly by not loading the whole contents of the file at once.

#### fnmatch\_extended

    boolean fnmatch_extended(string $pattern, string $path)
    
Match path against wildcard pattern. This is an extended version of [fnmatch](http://php.net/fnmatch).

* `?` Matches a single character, except `/`
* `#` Matches any decimal characters (0-9)
* `*` Matches any characters, except `/`
* `**` Matches any characters
* `[abc]` Matches `a`, `b` or `c`
* `{ab,cd,ef}` Matches `ab`, `cd` or `ef`


## Function handling functions

#### call\_user\_func\_assoc
    
    mixed call_user_func_assoc(callable $callback, array $param_arr)

Call a callback with named parameters as associative array.

## Object functions
    
#### object\_get\_properties

    array object_get_properties(object $object)

Get the public properties of an object.

Unlike `get_object_vars`, this method will return only public properties regardless of the scope.
    
#### object\_get\_properties

    array object_get_properties(object $object, bool $dynamic = true)

Get the public properties of an object.

Unlike `get_object_vars`, this method will return only public properties regardless of the scope.

The `dynamic` flag controls if the output should be filtered, so only properties defined in the class are set.

#### object\_set\_properties

    array object_get_properties(object $object, array $data, bool $dynamic = true)

Set the public properties of an object.

The `dynamic` flag controls if `$data` should be filtered, so only properties defined in the class are set.

