<?php

namespace Jasny\Tests;

use PHPStan\Testing\TestCase;

use function Jasny\array_only;
use function Jasny\array_without;
use function Jasny\array_contains_all;
use function Jasny\array_contains_all_assoc;
use function Jasny\array_contains_any;
use function Jasny\array_contains_any_assoc;
use function Jasny\array_find;
use function Jasny\array_find_key;
use function Jasny\array_flatten;
use function Jasny\array_join_pretty;

/**
 * Test array functions
 * @coversNothing
 */
class ArrayFunctionsTest extends TestCase
{
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
     * @covers Jasny\array_contains_all
     */
    public function testArrayContainsAll()
    {
        $this->assertTrue(array_contains_all(['foo', 'bar', 'baz', 'top'], ['top', 'bar']));
        $this->assertFalse(array_contains_all(['foo', 'baz', 'top'], ['top', 'bar']));
    }

    /**
     * @covers Jasny\array_contains_all
     */
    public function testArrayContainsAllWithEmpty()
    {
        $this->assertTrue(array_contains_all(['foo', 'bar', 'baz', 'top'], []));
    }

    /**
     * @covers Jasny\array_contains_all
     */
    public function testArrayContainsAllWithNested()
    {
        $this->assertTrue(array_contains_all(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['q', ['hello', 'world']]
        ));
        $this->assertTrue(array_contains_all(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            [(object)['a' => 'b']]
        ));
        
        $this->assertFalse(array_contains_all(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['q', ['hello']]
        ));
        $this->assertFalse(array_contains_all(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['q', ['hello', 'world', '!']]
        ));
    }
    
    /**
     * @covers Jasny\array_contains_all
     */
    public function testArrayContainsAllWithStrict()
    {
        $this->assertTrue(array_contains_all(['foo', 'bar', true], [1, 'bar']));
        $this->assertFalse(array_contains_all(['foo', 'bar', true], [1, 'bar'], true));
    }
    
    
    /**
     * @covers Jasny\array_contains_all_assoc
     */
    public function testArrayContainsAllAssoc()
    {
        $this->assertTrue(array_contains_all_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['top' => 3, 'bar' => 9]
        ));
        
        $this->assertFalse(array_contains_all_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['top' => 3, 'bar' => 7]
        ));
    }

    /**
     * @covers Jasny\array_contains_all_assoc
     */
    public function testArrayContainsAllAssocWithDifferentKeys()
    {
        $this->assertFalse(array_contains_all_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['top' => 3, 'wuz' => 7]
        ));
    }

    /**
     * @covers Jasny\array_contains_all_assoc
     */
    public function testArrayContainsAllAssocWithEmpty()
    {
        $this->assertTrue(array_contains_all_assoc(['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3], []));
    }

    /**
     * @covers Jasny\array_contains_all_assoc
     */
    public function testArrayContainsAllAssocWithNested()
    {
        $this->assertTrue(array_contains_all_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'greet' => ['hello', 'world']]
        ));
        
        $this->assertTrue(array_contains_all_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'item' => (object)['a' => 'b']]
        ));
        
        $this->assertFalse(array_contains_all_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'q', 'greet' => ['hello', 'world', '!']]
        ));
    }
    
    /**
     * @covers Jasny\array_contains_all_assoc
     */
    public function testArrayContainsAllAssocWithStrict()
    {
        $this->assertTrue(array_contains_all_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9]
        ));
        
        $this->assertFalse(array_contains_all_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9],
            true
        ));
    }


    /**
     * @covers Jasny\array_contains_any
     */
    public function testArrayContainsAny()
    {
        $this->assertTrue(array_contains_any(['foo', 'baz', 'top'], ['top', 'bar']));
        $this->assertFalse(array_contains_any(['foo', 'baz'], ['top', 'bar']));
    }

    /**
     * @covers Jasny\array_contains_any
     */
    public function testArrayContainsAnyWithEmpty()
    {
        $this->assertFalse(array_contains_any(['foo', 'baz', 'top'], []));
    }

    /**
     * @covers Jasny\array_contains_any
     */
    public function testArrayContainsAnyWithNested()
    {
        $this->assertTrue(array_contains_any(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['x', ['hello', 'world']]
        ));
        $this->assertTrue(array_contains_any(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            [(object)['a' => 'b']]
        ));

        $this->assertFalse(array_contains_any([['hello', 'world'], 'q', (object)['a' => 'b']], ['x', ['hello']]));
        $this->assertFalse(array_contains_any(
            [['hello', 'world'], 'q', (object)['a' => 'b']],
            ['x', ['hello', 'world', '!']]
        ));
    }

    /**
     * @covers Jasny\array_contains_any
     */
    public function testArrayContainsAnyWithStrict()
    {
        $this->assertTrue(array_contains_any(['foo', true], [1, 'bar']));
        $this->assertFalse(array_contains_any(['foo', true], [1, 'bar'], true));
    }


    /**
     * @covers Jasny\array_contains_any_assoc
     */
    public function testArrayContainsAnyAssoc()
    {
        $this->assertTrue(array_contains_any_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['taf' => 3, 'bar' => 9]
        ));

        $this->assertFalse(array_contains_any_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['taf' => 3, 'bar' => 7]
        ));
    }

    /**
     * @covers Jasny\array_contains_any_assoc
     */
    public function testArrayContainsAnyAssocWithDifferentKeys()
    {
        $this->assertFalse(array_contains_any_assoc(
            ['foo' => 7, 'bar' => 9, 'baz' => 12, 'top' => 3],
            ['taf' => 3, 'wuz' => 7]
        ));
    }

    /**
     * @covers Jasny\array_contains_any_assoc
     */
    public function testArrayContainsAnyAssocWithNested()
    {
        $this->assertTrue(array_contains_any_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'x', 'greet' => ['hello', 'world']]
        ));

        $this->assertTrue(array_contains_any_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'x', 'item' => (object)['a' => 'b']]
        ));

        $this->assertFalse(array_contains_any_assoc(
            ['greet' => ['hello', 'world'], 'x' => 'q', 'item' => (object)['a' => 'b']],
            ['x' => 'x', 'greet' => ['hello', 'world', '!']]
        ));
    }

    /**
     * @covers Jasny\array_contains_any_assoc
     */
    public function testArrayContainsAnyAssocWithStrict()
    {
        $this->assertTrue(array_contains_any_assoc(
            ['foo' => 7, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9]
        ));

        $this->assertFalse(array_contains_any_assoc(
            ['foo' => 7, 'baz' => 12, 'top' => true],
            ['top' => 1, 'bar' => 9],
            true
        ));
    }


    /**
     * @covers Jasny\array_find
     */
    public function testArrayFind()
    {
        $value = array_find(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($item) {
            return $item > 10 && $item < 100;
        });

        $this->assertEquals(42, $value);
    }

    /**
     * @covers Jasny\array_find
     */
    public function testArrayFindWithKey()
    {
        $value = array_find(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($key) {
            return strpos($key, 'u') !== false;
        }, ARRAY_FILTER_USE_KEY);

        $this->assertEquals(42, $value);
    }

    /**
     * @covers Jasny\array_find
     */
    public function testArrayFindWithBoth()
    {
        $value = array_find(['foo' => 8, 'bar' => 99, 'wuz' => 42, 'qux' => 111], function($item, $key) {
            return strpos($key, 'u') !== false && $item > 10;
        }, ARRAY_FILTER_USE_BOTH);

        $this->assertEquals(42, $value);
    }

    /**
     * @covers Jasny\array_find
     */
    public function testArrayFindWithNotFound()
    {
        $value = array_find(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($item) {
            return $item > 100000;
        });

        $this->assertFalse($value);
    }


    /**
     * @covers Jasny\array_find_key
     */
    public function testArrayFindKey()
    {
        $key = array_find_key(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($item) {
            return $item > 10 && $item < 100;
        });

        $this->assertEquals('wuz', $key);
    }

    /**
     * @covers Jasny\array_find_key
     */
    public function testArrayFindKeyWithKey()
    {
        $key = array_find_key(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($key) {
            return strpos($key, 'u') !== false;
        }, ARRAY_FILTER_USE_KEY);

        $this->assertEquals('wuz', $key);
    }

    /**
     * @covers Jasny\array_find_key
     */
    public function testArrayFindKeyWithBoth()
    {
        $key = array_find_key(['foo' => 8, 'bar' => 99, 'wuz' => 42, 'qux' => 111], function($item, $key) {
            return strpos($key, 'u') !== false && $item > 10;
        }, ARRAY_FILTER_USE_BOTH);

        $this->assertEquals('wuz', $key);
    }

    /**
     * @covers Jasny\array_find_key
     */
    public function testArrayFindKeyWithNotFound()
    {
        $key = array_find_key(['foo' => 8, 'wuz' => 42, 'bar' => 99, 'qux' => 111], function($item) {
            return $item > 100000;
        });

        $this->assertFalse($key);
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
