<?php

namespace Jasny;

use org\bovigo\vfs\vfsStream;

/**
 * Test server functions
 */
class FileFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $root;
    
    public function setUp() {
        $this->root = vfsStream::setup();
    }
    
    /**
     * @covers Jasny\file_contains
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
    
    
    public function fnmatchExtendedProvider()
    {
        return  [
            // Valid
            ['/foo/bar/zoo', '/foo/bar/zoo', true],

            ['/foo/?ar/zoo', '/foo/bar/zoo', true],
            ['/foo/*/zoo', '/foo/bar/zoo', true],
            ['/foo/b*/zoo', '/foo/bar/zoo', true],
            ['/foo/bar*/zoo', '/foo/bar/zoo', true],

            ['/foo/bar/#', '/foo/bar/22', true],
            ['/foo/bar/?#', '/foo/bar/a22', true],

            ['/foo/**', '/foo/bar/zoo', true],
            ['/foo/**', '/foo/', true],
            ['/foo/**', '/foo', true],

            ['/foo/{bar,baz}/zoo', '/foo/bar/zoo', true],
            ['/foo/{12,89}/zoo', '/foo/12/zoo', true],
            ['/foo/[bc]ar/zoo', '/foo/bar/zoo', true],
            ['/foo/[a-c]ar/zoo', '/foo/bar/zoo', true],

            // Invalid
            ['/foo/qux/zoo', '/foo/bar/zoo', false],

            ['/foo/?a/zoo', '/foo/bar/zoo', false],
            ['/foo/*/zoo', '/foo/zoo', false],

            ['/foo/bar/#', '/foo/bar/n00', false],
            ['/foo/bar/?#', '/foo/bar/2', false],

            ['/foo/**', '/foobar/zoo', false],

            ['/foo/{bar,baz}/zoo', '/foo/{bar,baz}/zoo', false],
            ['/foo/{12,89}/zoo', '/foo/1289/zoo', false],
            ['/foo/[bc]ar/zoo', '/foo/dar/zoo', false],
            ['/foo/[d-q]ar/zoo', '/foo/bar/zoo', false]
        ];
    }
    
    /**
     * @covers Jasny\fnmatch_extended
     * @dataProvider fnmatchExtendedProvider
     * 
     * @param string  $pattern
     * @param string  $path
     * @param boolean $expect
     */
    public function testFnmatchExtended($pattern, $path, $expect)
    {
        $this->assertEquals($expect, fnmatch_extended($pattern, $path));
    }
}

