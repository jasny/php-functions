<?php

declare(strict_types = 1);

namespace Jasny;

/**
 * Check if the file contains the specified string
 *
 * @param string $filename
 * @param string $str
 * @return bool
 */
function file_contains(string $filename, string $str): bool
{
    $handle = fopen($filename, 'r');

    if ($handle === false) {
        return false;
    }
    
    $valid = false;
    
    $len = max(2 * strlen($str), 256);
    $prev = '';
    
    while (!feof($handle)) {
        $cur = fread($handle, $len);
        
        if (strpos($prev . $cur, $str) !== false) {
            $valid = true;
            break;
        }
        $prev = $cur;
    }
    
    fclose($handle);
    
    return $valid;
}

/**
 * Match path against an extended wildcard pattern.
 *
 * @param string $pattern
 * @param string $path
 * @return bool
 */
function fnmatch_extended(string $pattern, string $path): bool
{
    $quoted = preg_quote($pattern, '~');
    
    $step1 = strtr($quoted, ['\?' => '[^/]', '\*' => '[^/]*', '/\*\*' => '(?:/.*)?', '#' => '\d+', '\[' => '[',
        '\]' => ']', '\-' => '-', '\{' => '{', '\}' => '}']);
    
    $step2 = preg_replace_callback('~{[^}]+}~', function ($part) {
        return '(?:' . substr(strtr($part[0], ',', '|'), 1, -1) . ')';
    }, $step1);
    
    $regex = rawurldecode($step2);

    return (bool)preg_match("~^{$regex}$~", $path);
}

