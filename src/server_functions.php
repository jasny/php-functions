<?php

namespace Jasny;

/**
 * Convert an IPv4 address or CIDR into an IP6 address or CIDR.
 * 
 * @param string $ip
 * @return string
 * @throws \InvalidArgumentException if ip isn't valid
 */
function ipv4_to_ipv6($ip)
{
    if ($ip === '0.0.0.0/0') {
        return '::';
    }

    list($address, $mask) = explode('/', $ip, 2) + [null, null];

    if (!filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) || (isset($mask) && !ctype_digit($mask))) {
        throw new \InvalidArgumentException("'$ip' is not a valid IPv4 address or cidr");
    }
    
    $bytes = array_map('dechex', explode('.', $address));
    
    return vsprintf('0:0:0:0:0:ffff:%02s%02s:%02s%02s', $bytes) . (isset($mask) ? '/' . ($mask + 96)  : '');
}

/**
 * Check if IP address is in CIDR block
 * 
 * @param string $ip     An IPv4 or IPv6
 * @param string $cidr   An IPv4 CIDR block or IPv6 CIDR block
 * @return boolean
 */
function ip_in_cidr($ip, $cidr)
{
    if ($cidr === '0.0.0.0/0' || $cidr === '::/0' || $cidr === '::') {
        return true;
    }
    
    $ipv = strpos($ip, ':') === false ? 4 : 6;
    $cidrv = strpos($cidr, ':') === false ? 4 : 6;
    
    try {
        if ($ipv < $cidrv) {
            $ip = ipv4_to_ipv6($ip);
            $ipv = 6;
        } elseif ($ipv > $cidrv) {
            $cidr = ipv4_to_ipv6($cidr);
        }
    } catch (\InvalidArgumentException $e) {
        return false;
    }
    
    $fn = __NAMESPACE__ . "\\ipv{$ipv}_in_cidr";
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
    list($subnet, $mask) = explode('/', $cidr, 2) + [null, '32'];
    
    if (
        !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ||
        !filter_var($subnet, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)
    ) {
        return false;
    }
    
    $ipLong = ip2long($ip);
    $subnetLong = ip2long($subnet);
    
    $ipMasked = $ipLong & ~((1 << (32 - $mask)) - 1);
    $subnetMasked = $subnetLong & ~((1 << (32 - $mask)) - 1);
    
    return $ipMasked == $subnetMasked;
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
    if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return false;
    }
    
    $inetIp = inet_pton($ip);
    $binaryIp = inet_to_bits($inetIp);

    if (strpos($cidr, '/') === false) {
        $net = $cidr;
        $mask = $cidr === '::' ? 0 : substr_count(rtrim($cidr, ':'), ':') * 16;
    } else {
        list($net, $mask) = explode('/', $cidr, 2);
    }

    if (!filter_var($net, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return false;
    }
        
    $inetNet = inet_pton($net);
    $binaryNet = inet_to_bits($inetNet);

    $ipNetBits = substr($binaryIp, 0, $mask);
    $netBits = substr($binaryNet, 0, $mask);

    return $ipNetBits === $netBits;
}

/**
 * Converts inet_pton output to string with bits.
 *
 * @param string $inet
 * @return string
 */
function inet_to_bits($inet)
{
    $unpackedArr = unpack('A16', $inet);
    $unpacked = str_split($unpackedArr[1]);
    
    $binaryip = '';

    foreach ($unpacked as $char) {
        $binaryip .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    }

    return str_pad($binaryip, 128, '0', STR_PAD_RIGHT);
}    
