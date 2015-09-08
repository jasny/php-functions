<?php

namespace Jasny;

/**
 * Check if the file contains the specified string
 *
 * @string $filename
 * @string $str
 * @return boolean
 */
function file_contains($filename, $str)
{
    $handle = fopen($filename, 'r');
    if (!$handle) return false;
    
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
 * Match path against wildcard pattern.
 *
 * @param string $pattern
 * @param string $path
 * @return boolean
 */
function fnmatch($pattern, $path)
{
    $quoted = preg_quote($pattern, '~');
    
    $step1 = strtr($quoted, ['\?' => '[^/]', '\*' => '[^/]*', '/\*\*' => '(?:/.*)?', '#' => '\d+', '\[' => '[',
        '\]' => ']', '\-' => '-', '\{' => '{', '\}' => '}']);
    
    $step2 = preg_replace_callback('~{[^}]+}~', function ($part) {
        return '(?:' . substr(strtr($part[0], ',', '|'), 1, -1) . ')';
    }, $step1);
    
    $regex = rawurldecode($step2);

    return (boolean)preg_match("~^{$regex}$~", $path);
}
