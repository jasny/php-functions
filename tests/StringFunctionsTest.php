<?php

/**
 * Test server functions
 */
class StringFunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * test camelcase
     */
    public function testCamelcase()
    {
        $this->assertEquals('FooBar', camelcase('foo bar'));
        $this->assertEquals('FooBar', camelcase('foo-bar'));
        $this->assertEquals('FooBar', camelcase('foo_bar'));
        $this->assertEquals('FooBarBazQUX', camelcase('foo - bar, .Baz QUX'));
        
        $this->assertEquals('fooBar', camelcase('foo bar', false));
    }
    
    /**
     * test snakecase
     */
    public function testSnakecase()
    {
        $this->assertEquals('foo_bar', snakecase('foo bar'));
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
        $this->assertEquals('foo-bar', kababcase('FooBar'));
        $this->assertEquals('foo-bar', kababcase('foo_bar'));
        $this->assertEquals('foo-bar-baz-qux', kababcase('fooBar, .Baz--QUX'));
    }
}

