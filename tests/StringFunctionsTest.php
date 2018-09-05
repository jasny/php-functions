<?php

namespace Jasny\Tests;

use PHPStan\Testing\TestCase;

use function Jasny\str_starts_with;
use function Jasny\str_ends_with;
use function Jasny\str_contains;
use function Jasny\str_before;
use function Jasny\str_after;
use function Jasny\str_remove_accents;
use function Jasny\str_slug;

/**
 * Test string functions
 * @coversNothing
 */
class StringFunctionsTest extends TestCase
{
    /**
     * @covers Jasny\str_starts_with
     */
    public function testStrStartsWith()
    {
        $this->assertTrue(str_starts_with('foobar', 'foo'));
        $this->assertTrue(str_starts_with('foobar', 'foobar'));
        
        $this->assertFalse(str_starts_with('foobar', 'qux'));
        $this->assertFalse(str_starts_with('foobar', 'bar'));
        $this->assertFalse(str_starts_with('foobar', 'oba'));        
        $this->assertFalse(str_starts_with('foobar', 'foobarqux'));
    }
    
    /**
     * @covers Jasny\str_ends_with
     */
    public function testStrEndsWith()
    {
        $this->assertTrue(str_ends_with('foobar', 'bar'));
        $this->assertTrue(str_ends_with('foobar', 'foobar'));
        
        $this->assertFalse(str_ends_with('foobar', 'qux'));
        $this->assertFalse(str_ends_with('foobar', 'foo'));
        $this->assertFalse(str_ends_with('foobar', 'oba'));        
        $this->assertFalse(str_ends_with('foobar', 'quxfoobar'));
    }
    
    /**
     * @covers Jasny\str_contains
     */
    public function testStrContains()
    {
        $this->assertTrue(str_contains('foobar', 'oba'));
        $this->assertTrue(str_contains('foobar', 'foo'));
        $this->assertTrue(str_contains('foobar', 'bar'));
        $this->assertTrue(str_contains('foobar', 'foobar'));
                
        $this->assertFalse(str_contains('foobar', 'qux'));
        $this->assertFalse(str_contains('foobar', 'quxfoobar'));
    }
    

    public function strBeforeProvider()
    {
        return [
            ['foo', ';', 'foo'],
            ['foo;bar', ';', 'foo'],
            ['foo;bar;zoo', ';', 'foo'],
            [';bar;zoo', ';', ''],
            ['fooababar', 'aba', 'foo']
        ];
    }

    /**
     * @covers Jasny\str_before
     * @dataProvider strBeforeProvider
     *
     * @param string $string
     * @param string $expect
     */
    public function testStrBefore($string, $substr, $expect)
    {
        $this->assertSame($expect, str_before($string, $substr));
    }
    

    public function strAfterProvider()
    {
        return [
            ['foo', ';', ''],
            ['bar;foo', ';', 'foo'],
            ['bar;foo;zoo', ';', 'foo;zoo'],
            [';foo;zoo', ';', 'foo;zoo'],
            ['barabafoo', 'aba', 'foo'],
            ['abababababa', 'aba', 'babababa']
        ];
    }

    /**
     * @covers Jasny\str_after
     * @dataProvider strAfterProvider
     *
     * @param string $string
     * @param string $expect
     */
    public function testStrAfter($string, $substr, $expect)
    {
        $this->assertSame($expect, str_after($string, $substr));
    }


    /**
     * @covers Jasny\str_remove_accents
     */
    public function testStrRemoveAccents()
    {
        $this->assertSame('abcdehij', str_remove_accents('ábcdëhĳ'));
    }
    
    /**
     * @covers Jasny\str_slug
     */
    public function testStrSlug()
    {
        $this->assertSame('john-doe-master-ruler', str_slug('John Doé - master & ruler'));
    }
}

