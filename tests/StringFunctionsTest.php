<?php

namespace Jasny;

/**
 * Test string functions
 */
class StringFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test str_starts_with
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
     * test str_ends_with
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
     * test str_contains
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
    
    /**
     * test str_remove_accents
     */
    public function testStrRemoveAccents()
    {
        $this->assertSame('abcdehij', str_remove_accents('ábcdëhĳ'));
    }
    
    /**
     * test str_slug
     */
    public function testStrSlug()
    {
        $this->assertSame('john-doe-master-ruler', str_slug('John Doé - master & ruler'));
    }
}

