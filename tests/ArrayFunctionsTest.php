<?php

/**
 * Test array functions
 */
class ArrayFunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * test extract_keys
     */
    public function testExtractKeys()
    {
        $this->assertEquals([10, 20], extract_keys(['foo' => 20, 'bar' => 10, 'qux' => 99], ['bar', 'foo']));
        
        $this->assertEquals(
            [null, 20, 300],
            extract_keys(['foo' => 20, 'qux' => 99], ['bar', 'foo' => 0, 'jazz' => 300])
        );
    }

    /**
     * test array_unset with associated arrays
     */
    function testArrayUnset_array()
    {
        $array = [
            ['foo' => 1, 'bar' => 20, 'qux' => 99],
            ['foo' => 2, 'bar' => 30, 'qux' => 99],
            ['foo' => 3, 'bar' => 40],
            ['foo' => 4, 'qux' => 99]
        ];
    
        $expect = [
            ['foo' => 1, 'qux' => 99],
            ['foo' => 2, 'qux' => 99],
            ['foo' => 3],
            ['foo' => 4, 'qux' => 99]
        ];
        
        array_unset($array, 'bar');
        $this->assertEquals($expect, $array);
    }
    
    /**
     * test array_unset with objects
     */
    function testArrayUnset_object()
    {
        $t1 = (object)['foo' => 1, 'bar' => 20, 'qux' => 99];
        $t2 = (object)['foo' => 2, 'bar' => 30, 'qux' => 99];
        $t3 = (object)['foo' => 3, 'bar' => 40];
        $t4 = (object)['foo' => 4, 'qux' => 99];
        
        $array = [$t1, $t2, $t3, $t4];
        
        $expect = [
            (object)['foo' => 1, 'qux' => 99],
            (object)['foo' => 2, 'qux' => 99],
            (object)['foo' => 3],
            (object)['foo' => 4, 'qux' => 99]
        ];
        
        array_unset($array, 'bar');
        $this->assertEquals($expect, $array);
        
        $this->assertEquals($t1, (object)['foo' => 1, 'bar' => 20, 'qux' => 99], "Original hasn't changed");
    }
}

