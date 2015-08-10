<?php

use org\bovigo\vfs\vfsStream;

/**
 * Test server functions
 */
class FileFunctionsTest extends PHPUnit_Framework_TestCase
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
        
        $this->assertTrue(str_in_file($file, substr($text, 140, 300)), 'long sub string');
    }
}

