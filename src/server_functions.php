<?php

namespace Jasny;

/**
 * Check if an IP is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ip_in_cidr($ip, $cidr)
{
    $parts = explode('/', $cidr);
    
    $ipc_bytes = explode('.', $parts[0]);
    foreach ($ipc_bytes as &$v) {
        $v = str_pad(decbin($v), 8, '0', STR_PAD_LEFT);
    }
    $ipc = substr(join('', $ipc_bytes), 0, $parts[1]);
    
    $ipu_bytes = explode('.', $ip);
    foreach ($ipu_bytes as &$v) {
        $v = str_pad(decbin($v), 8, '0', STR_PAD_LEFT);
    }
    $ipu = substr(join('', $ipu_bytes), 0, $parts[1]);
    
    return $ipu == $ipc;
}
