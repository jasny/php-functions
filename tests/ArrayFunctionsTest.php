<?php

namespace Jasny;

/**
 * Test array functions
 */
class ArrayFunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Jasny\extract_keys
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
     * @covers Jasny\array_unset
     */
    public function testArrayUnsetWithArray()
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
        $this->assertSame($expect, $array);
    }
    
    /**
     * @covers Jasny\array_unset
     */
    public function testArrayUnsetWithObject()
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
        $this->assertEquals($t1, $array[0]);
    }
    
    
    /**
     * @covers Jasny\array_only
     */
    public function testArrayOnly()
    {
        $array = ['baz' => null, 'foo' => 1, 'bar' => 20, 'qux' => 99];
        $expect = ['foo' => 1, 'bar' => 20];
        
        $this->assertSame($expect, array_only($array, ['bar', 'foo', 'jazz']));
    }
    
    /**
     * @covers Jasny\array_without
     */
    public function testArrayWithout()
    {
        $array = ['baz' => null, 'foo' => 1, 'bar' => 20, 'qux' => 99];
        $expect = ['baz' => null, 'qux' => 99];
        
        $this->assertSame($expect, array_without($array, ['bar', 'foo', 'jazz']));
    }
    
    
    /**
     * @covers Jasny\array_contains
     */
    public function testArrayContains()
    {
        $this->assertTrue(array_contains(['foo', 'bar', 'baz', 'top'], ['top', 'bar']));
        $this->assertFalse(array_contains(['foo', 'baz', 'top'], ['top', 'bar']));
    }
    
    /**
     * @covers Jasny\array_contains
     */
    public function testArrayContainsWithNested()
    {
        $this->assertTrue(array_contains([['hello', 'world'], 'q', (object)['a' => 'b']], ['q', ['hello', 'world']]));
        $this->assertTrue(array_contains([['hello', 'world'], 'q', (object)['a' => 'b']], [(object)['a' => 'b']]));
        
        $this->assertFalse(array_contains([['hello', 'world'], 'q', (object)['a' => 'b']], ['q', ['hello']]));
        $this->assertFalse(array_contains(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['q', ['hello', 'world', '!']]
        ));
    }
    
    /**
     * @covers Jasny\array_contains
     */
    public function testArrayContainsWithStrict()
    {
        $this->assertTrue(array_contains(['foo', 'bar', true], [1, 'bar']));
        $this->assertFalse(array_contains(['foo', 'bar', true], [1, 'bar'], true));
    }
    
    
    /**
     * @covers Jasny\array_has_subset
     */
    public function testArrayHasSubset()
    {
        $this->assertTrue(array_has_subset(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['top' => 3, 'bar' => 9]
        ));
        
        $this->assertFalse(array_has_subset(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['top' => 3, 'bar' => 7]
        ));
    }
    
    /**
     * @covers Jasny\array_has_subset
     */
    public function testArrayHasSubsetWithNested()
    {
        $this->assertTrue(array_has_subset(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'greet' => ['hello', 'world']]
        ));
        
        $this->assertTrue(array_has_subset(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'item' => (object)['a' => 'b']]
        ));
        
        $this->assertFalse(array_has_subset(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'greet' => ['hello', 'world', '!']]
        ));
    }
    
    /**
     * @covers Jasny\array_has_subset
     */
    public function testArrayHasSubsetWithStrict()
    {
        $this->assertTrue(array_has_subset(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9]
        ));
        
        $this->assertFalse(array_has_subset(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9],
            true
        ));
    }

    public function arrayFlattenGlueProvider()
    {
        $expectDot = [
            'animal.mammel' => [
                'ape',
                'bear'
            ],
            'animal.reptile' => 'chameleon',
            'colors.red' => 60,
            'colors.green' => 100,
            'colors.blue' => 0,
            'topic' => 'green',
            'a.b.c.d' => 42
        ];

        $expectDash = [
            'animal-mammel' => [
                'ape',
                'bear'
            ],
            'animal-reptile' => 'chameleon',
            'colors-red' => 60,
            'colors-green' => 100,
            'colors-blue' => 0,
            'topic' => 'green',
            'a-b-c-d' => 42
        ];
        
        return [
            [null, $expectDot],
            ['.', $expectDot],
            ['-', $expectDash]
        ];
    }
    
    /**
     * @covers Jasny\array_flatten
     * @dataProvider arrayFlattenGlueProvider
     * 
     * @param string $glue
     * @param array  $expect
     */
    public function testArrayFlatten($glue, array $expect)
    {
        $values = [
            'animal' => [
                'mammel' => [
                    'ape',
                    'bear'
                ],
                'reptile' => 'chameleon'
            ],
            'colors' => [
                'red' => 60,
                'green' => 100,
                'blue' => 0
            ],
            'topic' => 'green',
            'a' => [
                'b' => [
                    'c' => [
                        'd' => 42
                    ]
                ]
            ]
        ];

        $flattened = isset($glue) ? array_flatten($values, $glue) : array_flatten($values);
        
        $this->assertEquals($expect, $flattened);
    }


    public function arrayJoinPrettyArrayProvider()
    {
        return [
            [[], ''],
            [['foo'], 'foo'],
            [['foo', 'bar'], 'foo&bar'],
            [['foo', 'bar', 'zoo'], 'foo,bar&zoo'],
            [[11, 22, 33, 44], '11,22,33&44']
        ];
    }
    
    /**
     * @covers Jasny\array_join_pretty
     * @dataProvider arrayJoinPrettyArrayProvider
     * 
     * @param array  $array
     * @param string $expect
     */
    public function testArrayJoinPretty($array, $expect)
    {
        $this->assertEquals($expect, array_join_pretty(',', '&', $array));
    }
}
