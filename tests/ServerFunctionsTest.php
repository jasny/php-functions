<?php

/**
 * Test server functions
 */
class ServerFunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * test ip_in_cidr
     */
    public function testIpInCidr()
    {
        $this->assertTrue(ip_in_cidr('192.168.0.1', '192.168.0.1/32'));
        $this->assertTrue(ip_in_cidr('192.168.0.1', '192.168.0.0/24'));
        $this->assertTrue(ip_in_cidr('192.168.0.1', '192.168.0.10/24'));
        $this->assertTrue(ip_in_cidr('192.168.0.1', '192.128.0.0/9'));
        $this->assertTrue(ip_in_cidr('192.168.0.1', '0.0.0.0/0'));
        
        $this->assertFalse(ip_in_cidr('192.168.0.1', '192.168.0.10/32'));
        $this->assertFalse(ip_in_cidr('192.168.0.1', '192.168.1.0/24'));
        $this->assertFalse(ip_in_cidr('192.168.0.1', '192.64.0.0/9'));
    }
}

