<?php

namespace Jasny;

/**
 * Test case functions
 */
class CaseFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test camelcase
     */
    public function testCamelcase()
    {
        $this->assertEquals('fooBar', camelcase('foo bar'));
        $this->assertEquals('fooBar', camelcase('FooBar'));
        $this->assertEquals('fooBar', camelcase('foo-bar'));
        $this->assertEquals('fooBar', camelcase('foo_bar'));
        $this->assertEquals('fooBarBazQUX', camelcase('foo - bar, .Baz QUX'));
    }
    
    /**
     * test studly
     */
    public function testStudlycase()
    {
        $this->assertEquals('FooBar', studlycase('foo bar'));
        $this->assertEquals('FooBar', studlycase('fooBar'));
        $this->assertEquals('FooBar', studlycase('foo-bar'));
        $this->assertEquals('FooBar', studlycase('foo_bar'));
        $this->assertEquals('FooBarBazQUX', studlycase('foo - bar, .Baz QUX'));
    }
    
    /**
     * test snakecase
     */
    public function testSnakecase()
    {
        $this->assertEquals('foo_bar', snakecase('foo bar'));
        $this->assertEquals('foo_bar', snakecase('fooBar'));
        $this->assertEquals('foo_bar', snakecase('FooBar'));
        $this->assertEquals('foo_bar', snakecase('foo_bar'));
        $this->assertEquals('foo_bar_baz_qux', snakecase('fooBar, .Baz__QUX'));
    }
    
    /**
     * test kababcase
     */
    public function testKababcase()
    {
        $this->assertEquals('foo-bar', kababcase('foo bar'));
        $this->assertEquals('foo-bar', kababcase('fooBar'));
        $this->assertEquals('foo-bar', kababcase('FooBar'));
        $this->assertEquals('foo-bar', kababcase('foo_bar'));
        $this->assertEquals('foo-bar-baz-qux', kababcase('fooBar, .Baz--QUX'));
    }
    
    /**
     * test uncase
     */
    public function testUncase()
    {
        $this->assertEquals('foo bar', uncase('fooBar'));
        $this->assertEquals('Foo bar', uncase('FooBar'));
        $this->assertEquals('foo bar', uncase('foo_bar'));
        $this->assertEquals('foo bar', uncase('foo-bar'));
        $this->assertEquals('foo bar, .baz qux', uncase('fooBar, .Baz--QUX'));
    }
}

