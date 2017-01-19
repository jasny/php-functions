<?php

namespace Jasny;

/**
 * Test case functions
 */
class CaseFunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function fooBarProvider()
    {
        return [
            ['foo bar'],
            ['fooBar'],
            ['FooBar'],
            ['foo-bar'],
            ['foo_bar']
        ];
    }
    
    /**
     * @covers Jasny\camelcase
     * @dataProvider fooBarProvider
     * 
     * @param string $fooBar
     */
    public function testCamelcase($fooBar)
    {
        $this->assertEquals('fooBar', camelcase($fooBar));
    }
    
    /**
     * @covers Jasny\studlycase
     * @dataProvider fooBarProvider
     * 
     * @param string $fooBar
     */
    public function testStudlycase($fooBar)
    {
        $this->assertEquals('FooBar', studlycase($fooBar));
    }
    
    /**
     * @covers Jasny\snakecase
     * @dataProvider fooBarProvider
     * 
     * @param string $fooBar
     */
    public function testSnakecase($fooBar)
    {
        $this->assertEquals('foo_bar', snakecase($fooBar));
    }
    
    /**
     * @covers Jasny\kababcase
     * @dataProvider fooBarProvider
     * 
     * @param string $fooBar
     */
    public function testKababcase($fooBar)
    {
        $this->assertEquals('foo-bar', kababcase($fooBar));
    }
    
    /**
     * @covers Jasny\uncase
     * @dataProvider fooBarProvider
     * 
     * @param string $fooBar
     */
    public function testUncase($fooBar)
    {
        $this->assertEquals('foo bar', uncase($fooBar));
    }
    
    
    public function sentenceProvider()
    {
        return [
            ['fooBar, .Baz--QUX']
        ];
    }
    
    /**
     * @covers Jasny\camelcase
     * @dataProvider sentenceProvider
     * 
     * @param string $sentence
     */
    public function testCamelcaseWithSentence($sentence)
    {
        $this->assertEquals('fooBarBazQUX', camelcase($sentence));
    }
    
    /**
     * @covers Jasny\studlycase
     * @dataProvider sentenceProvider
     * 
     * @param string $sentence
     */
    public function testStudlycaseWithSentence($sentence)
    {
        $this->assertEquals('FooBarBazQUX', studlycase($sentence));
    }
    
    /**
     * @covers Jasny\snakecase
     * @dataProvider sentenceProvider
     * 
     * @param string $sentence
     */
    public function testSnakecaseWithSentence($sentence)
    {
        $this->assertEquals('foo_bar_baz_qux', snakecase($sentence));
    }
    
    /**
     * @covers Jasny\kababcase
     * @dataProvider sentenceProvider
     * 
     * @param string $sentence
     */
    public function testKababcaseWithSentence($sentence)
    {
        $this->assertEquals('foo-bar-baz-qux', kababcase($sentence));
    }
    
    /**
     * @covers Jasny\uncase
     * @dataProvider sentenceProvider
     * 
     * @param string $sentence
     */
    public function testUncaseWithSentence($sentence)
    {
        $this->assertEquals('foo bar, .baz qux', uncase($sentence));
    }
}
