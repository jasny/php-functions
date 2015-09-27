<?php

/**
 * Check if IP address is in CIDR block
 * 
 * @todo Convert IPv4 to IPv6 and visa versa (when possible)
 *
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ip_in_cidr($ip, $cidr)
{
    if ($cidr === '0.0.0.0/0' || $cidr === '::/0' || $cidr === '::') return true;

    $ipv = strpos($ip, ':') === false ? 4 : 6;
    $cidrv = strpos($cidr, ':') === false ? 4 : 6;
     
    if ($ipv !== $cidrv) return false;
    
    $fn = "ipv{$ipv}_in_cidr";
    return $fn($ip, $cidr);
}

/**
 * Check if IPv4 address is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ipv4_in_cidr($ip, $cidr)
{
    list($subnet, $mask) = explode('/', $cidr);
    
    $ipMasked = ip2long($ip) & ~((1 << (32 - $mask)) - 1);
    $subnetMasked = ip2long($subnet) & ~((1 << (32 - $mask)) - 1);
    
    return $ipMasked == $subnetMasked;
}

/**
 * Converts inet_pton output to string with bits
 *
 * @param string $inet
 * @return string
 */
function inet_to_bits($inet)
{
   $unpacked = unpack('A16', $inet);
   $unpacked = str_split($unpacked[1]);
   $binaryip = '';

   foreach ($unpacked as $char) {
             $binaryip .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
   }
   
   return $binaryip;
}    

/**
 * Check if IPv6 address is in CIDR block
 * 
 * @param string $ip
 * @param string $cidr
 * @return boolean
 */
function ipv6_in_cidr($ip, $cidr)
{
    $inetIp = inet_pton($ip);
    $binaryIp = inet_to_bits($inetIp);

    if (strpos($cidr, '/') === false) {
        $net = $cidr;
        $mask = $cidr === '::' ? 0 : substr_count(rtrim($cidr, ':'), ':') * 16;
    } else {
        list($net, $mask) = explode('/', $cidr);
    }

    $inetNet = inet_pton($net);
    $binaryNet = inet_to_bits($inetNet);

    $ipNetBits = substr($binaryIp, 0, $mask);
    $netBits = substr($binaryNet, 0, $mask);

    return $ipNetBits === $netBits;
}

