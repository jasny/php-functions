<?php

namespace Jasny;

use org\bovigo\vfs\vfsStream;

/**
 * Test server functions
 */
class FileFunctionsTest extends \PHPUnit_Framework_TestCase
{
    private $root;
    
    public function setUp() {
        $this->root = vfsStream::setup();
    }
    
    /**
     * test str_in_file
     */
    public function testStrInFile()
    {
        $file = $this->root->url() . '/abc.txt';
        $text = wordwrap(str_repeat("abcdefghijklmopqrstuvwxyz", 100), 80, "\n", true);
        file_put_contents($file, $text);
        
        $this->assertTrue(str_in_file($file, "klm"), "klm");
        $this->assertTrue(str_in_file($file, "abcde\nfgh"), 'abcd\nefgh');
        
        $this->assertFalse(str_in_file($file, "foobar"), "foobar");
        
        $this->assertTrue(str_in_file($file, substr($text, 140, 400)), 'long sub string');
    }
    
    /**
     * test fnmatch_extended
     */
    public function testFnmatchExtended()
    {
        // Valid
        $this->assertTrue(fnmatch_extended('/foo/bar/zoo', '/foo/bar/zoo'));
        
        $this->assertTrue(fnmatch_extended('/foo/?ar/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/*/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/b*/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/bar*/zoo', '/foo/bar/zoo'));
                
        $this->assertTrue(fnmatch_extended('/foo/bar/#', '/foo/bar/22'));
        $this->assertTrue(fnmatch_extended('/foo/bar/?#', '/foo/bar/a22'));
        
        $this->assertTrue(fnmatch_extended('/foo/**', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/**', '/foo/'));
        $this->assertTrue(fnmatch_extended('/foo/**', '/foo'));
                        
        $this->assertTrue(fnmatch_extended('/foo/{bar,baz}/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/{12,89}/zoo', '/foo/12/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/[bc]ar/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch_extended('/foo/[a-c]ar/zoo', '/foo/bar/zoo'));
        
        // Invalid
        $this->assertFalse(fnmatch_extended('/foo/qux/zoo', '/foo/bar/zoo'));
        
        $this->assertFalse(fnmatch_extended('/foo/?a/zoo', '/foo/bar/zoo'));
        $this->assertFalse(fnmatch_extended('/foo/*/zoo', '/foo/zoo'));
        
        $this->assertFalse(fnmatch_extended('/foo/bar/#', '/foo/bar/n00'));
        $this->assertFalse(fnmatch_extended('/foo/bar/?#', '/foo/bar/2'));
        
        $this->assertFalse(fnmatch_extended('/foo/**', '/foobar/zoo'));
                
        $this->assertFalse(fnmatch_extended('/foo/{bar,baz}/zoo', '/foo/{bar,baz}/zoo'));
        $this->assertFalse(fnmatch_extended('/foo/{12,89}/zoo', '/foo/1289/zoo'));
        $this->assertFalse(fnmatch_extended('/foo/[bc]ar/zoo', '/foo/dar/zoo'));
        $this->assertFalse(fnmatch_extended('/foo/[d-q]ar/zoo', '/foo/bar/zoo'));
    }
}

