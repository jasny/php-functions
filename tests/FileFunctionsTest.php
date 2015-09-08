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
     * test file_contains
     */
    public function testFileContains()
    {
        $file = $this->root->url() . '/abc.txt';
        $text = wordwrap(str_repeat("abcdefghijklmopqrstuvwxyz", 100), 80, "\n", true);
        file_put_contents($file, $text);
        
        $this->assertTrue(file_contains($file, "klm"), "klm");
        $this->assertTrue(file_contains($file, "abcde\nfgh"), 'abcd\nefgh');
        
        $this->assertFalse(file_contains($file, "foobar"), "foobar");
        
        $this->assertTrue(file_contains($file, substr($text, 140, 400)), 'long sub string');
    }
    
    /**
     * test fnmatch
     */
    public function testFnmatchExtended()
    {
        // Valid
        $this->assertTrue(fnmatch('/foo/bar/zoo', '/foo/bar/zoo'));
        
        $this->assertTrue(fnmatch('/foo/?ar/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/*/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/b*/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/bar*/zoo', '/foo/bar/zoo'));
                
        $this->assertTrue(fnmatch('/foo/bar/#', '/foo/bar/22'));
        $this->assertTrue(fnmatch('/foo/bar/?#', '/foo/bar/a22'));
        
        $this->assertTrue(fnmatch('/foo/**', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/**', '/foo/'));
        $this->assertTrue(fnmatch('/foo/**', '/foo'));
                        
        $this->assertTrue(fnmatch('/foo/{bar,baz}/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/{12,89}/zoo', '/foo/12/zoo'));
        $this->assertTrue(fnmatch('/foo/[bc]ar/zoo', '/foo/bar/zoo'));
        $this->assertTrue(fnmatch('/foo/[a-c]ar/zoo', '/foo/bar/zoo'));
        
        // Invalid
        $this->assertFalse(fnmatch('/foo/qux/zoo', '/foo/bar/zoo'));
        
        $this->assertFalse(fnmatch('/foo/?a/zoo', '/foo/bar/zoo'));
        $this->assertFalse(fnmatch('/foo/*/zoo', '/foo/zoo'));
        
        $this->assertFalse(fnmatch('/foo/bar/#', '/foo/bar/n00'));
        $this->assertFalse(fnmatch('/foo/bar/?#', '/foo/bar/2'));
        
        $this->assertFalse(fnmatch('/foo/**', '/foobar/zoo'));
                
        $this->assertFalse(fnmatch('/foo/{bar,baz}/zoo', '/foo/{bar,baz}/zoo'));
        $this->assertFalse(fnmatch('/foo/{12,89}/zoo', '/foo/1289/zoo'));
        $this->assertFalse(fnmatch('/foo/[bc]ar/zoo', '/foo/dar/zoo'));
        $this->assertFalse(fnmatch('/foo/[d-q]ar/zoo', '/foo/bar/zoo'));
    }
}

