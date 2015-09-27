<?php

/**
 * Test server functions
 */
class ServerFunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * test ipv4_in_cidr
     */
    public function testIpv4InCidr()
    {
        $this->assertTrue(ipv4_in_cidr('192.168.0.1', '192.168.0.1/32'));
        $this->assertTrue(ipv4_in_cidr('192.168.0.1', '192.168.0.0/24'));
        $this->assertTrue(ipv4_in_cidr('192.168.0.1', '192.168.0.10/24'));
        $this->assertTrue(ipv4_in_cidr('192.168.0.1', '192.128.0.0/9'));
        $this->assertTrue(ipv4_in_cidr('192.168.0.1', '0.0.0.0/0'));
        
        $this->assertFalse(ipv4_in_cidr('192.168.0.1', '192.168.0.10/32'));
        $this->assertFalse(ipv4_in_cidr('192.168.0.1', '192.168.1.0/24'));
        $this->assertFalse(ipv4_in_cidr('192.168.0.1', '192.64.0.0/9'));
    }

    /**
     * test ipv6_in_cidr
     */    
    public function testIpv6InCidr()
    {
        $this->assertTrue(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B::/64'));
        $this->assertTrue(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:0000:0000:0000:0000/64'));
        $this->assertTrue(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:0200::/72'));
        $this->assertTrue(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B::'));
        $this->assertTrue(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '::'));
    
        $this->assertFalse(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2000::/64'));
        $this->assertFalse(ipv6_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:9900::/72'));
    }
    
    /**
     * test ip_in_cidr
     *
     * @depends testIpv4InCidr
     * @depends testIpv6InCidr
     */
    public function testIpInCidr()
    {
        $this->assertTrue(ip_in_cidr('192.168.0.1', '192.168.0.1/32'));
        $this->assertTrue(ip_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B::/64'));
        
        $this->assertFalse(ip_in_cidr('192.168.0.1', '192.168.0.10/32'));
        $this->assertFalse(ip_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2000::/64'));
        
        $this->assertFalse(ip_in_cidr('192.168.0.1', '21DA:00D3:0000:2F3B::/64'));
        $this->assertFalse(ip_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '192.168.0.10/32'));
        
        $this->assertTrue(ip_in_cidr('192.168.0.1', '::'));
        $this->assertTrue(ip_in_cidr('21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '0.0.0.0/0'));
    }
}

