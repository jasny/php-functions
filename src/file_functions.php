<?php

/**
 * Check if the file contains the specified string
 *
 * @string $filename
 * @string $str
 * @return boolean
 */
function str_in_file($filename, $str)
{
    $handle = fopen($filename, 'r');
    if (!$handle) return false;
    
    $valid = false;
    
    $len = max(2 * strlen($str), 256);
    $prev = '';
    
    while (!feof($handle)) {
        $cur = fread($handle, 256);
        
        if (strpos($prev . $cur, $str) !== false) {
            $valid = true;
            break;
        }
        $prev = $cur;
    }
    
    fclose($handle);
    
    return $valid;
}

