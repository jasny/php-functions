<?php

namespace Jasny;

/**
 * Test server functions
 */
class ServerFunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function ipv4ToIpv6Provider()
    {
        return [
            ['127.0.0.1', '0:0:0:0:0:ffff:7f00:0001'],
            ['192.168.0.1', '0:0:0:0:0:ffff:c0a8:0001'],
            ['192.168.0.0/24', '0:0:0:0:0:ffff:c0a8:0000/120'],
            ['0.0.0.0/0', '::']
        ];
    }
    
    /**
     * @covers Jasny\ipv4_to_ipv6
     * @dataProvider ipv4ToIpv6Provider
     * 
     * @param string $ip
     * @param string $expect
     */
    public function testIpv4ToIpv6($ip, $expect)
    {
        $this->assertEquals($expect, ipv4_to_ipv6($ip));
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage 'foo' is not a valid IPv4 address or cidr
     */
    public function testIpv4ToIpv6WithInvalidIP()
    {
        ipv4_to_ipv6('foo');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage '21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A' is not a valid IPv4 address or cidr
     */
    public function testIpv4ToIpv6WithIpv6()
    {
        ipv4_to_ipv6("21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A");
    }
    
    public function ipv4Provider()
    {
        return [
            ['192.168.0.1', '192.168.0.1/32', true],
            ['192.168.0.1', '192.168.0.1', true],
            ['192.168.0.1', '192.168.0.0/24', true],
            ['192.168.0.1', '192.168.0.10/24', true],
            ['192.168.0.1', '192.128.0.0/9', true],
            ['192.168.0.1', '0.0.0.0/0', true],

            ['192.168.0.1', '192.168.0.10/32', false],
            ['192.168.0.1', '192.168.0.0', false],
            ['192.168.0.1', '192.168.1.0/24', false],
            ['192.168.0.1', '192.64.0.0/9', false],
            
            ['192.168.0.1', 'foo', false],
            ['foo', '192.64.0.0/9', false],
            ['foo', 'foo', false]
        ];
    }
    
    /**
     * @covers Jasny\ipv4_in_cidr
     * @dataProvider ipv4Provider
     * 
     * @param string  $address
     * @param string  $cidr
     * @param boolean $expect
     */
    public function testIpv4InCidr($address, $cidr, $expect)
    {
        $this->assertEquals($expect, ipv4_in_cidr($address, $cidr), "$address in $cidr");
    }
    
    public function ipv6Provider()
    {
        return [
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A/128', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C00/120', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:0001', '21DA:00D3:0000:2F3B:02AC:00FF:FE28:0000/120', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B::/64', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:0000:0000:0000:0000/64', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:0200::/72', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B::', true],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '::', true],
            ['0:0:0:0:0:FFFF:C0A8:0001', '0:0:0:0:0:FFFF:C0A8:0000/112', true],

            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2000::/64', false],
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '21DA:00D3:0000:2F3B:9900::/72', false],
            
            ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', 'foo', false],
            ['foo', '21DA:00D3:0000:2F3B:0000:0000:0000:0000/64', false],
            ['foo', 'foo', false]
        ];
    }

    /**
     * @covers Jasny\ipv6_in_cidr
     * @covers Jasny\inet_to_bits
     * 
     * @dataProvider ipv6Provider
     * 
     * @param string  $address
     * @param string  $cidr
     * @param boolean $expect
     */    
    public function testIpv6InCidr($address, $cidr, $expect)
    {
        $this->assertEquals($expect, ipv6_in_cidr($address, $cidr), "$address in $cidr");
    }
    
    
    public function ipProvider()
    {
        return array_merge(
            $this->ipv4Provider(),
            $this->ipv6Provider(),
            [
                ['192.168.0.1', '::', true],
                ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '0.0.0.0/0', true],
                ['192.168.0.1', '0:0:0:0:0:FFFF:C0A8:0000/24', true],
                ['192.168.0.1', '0:0:0:0:0:FFFF:C0A8::', true],
                ['0:0:0:0:0:FFFF:C0A8:0001', '192.168.0.1/32', true],
                ['0:0:0:0:0:FFFF:C0A8:0001', '192.168.0.0/24', true],
                
                ['192.168.0.1', '0:0:0:0:0:FFFF:C0A8:0002/128', false],
                ['0:0:0:0:0:FFFF:C0A8:0001', '192.168.0.2/32', false],
                ['192.168.0.1', '21DA:00D3:0000:2F3B::/64', false],
                ['21DA:00D3:0000:2F3B:02AC:00FF:FE28:9C5A', '192.168.0.10/32', false]
            ]
        );
    }
    
    /**
     * @covers Jasny\ip_in_cidr
     *
     * @dataProvider ipProvider
     * 
     * @depends testIpv4InCidr
     * @depends testIpv6InCidr
     * 
     * @param string  $address
     * @param string  $cidr
     * @param boolean $expect
     */
    public function testIpInCidr($address, $cidr, $expect)
    {
        $this->assertEquals($expect, ip_in_cidr($address, $cidr), "$address in $cidr");
    }
}
