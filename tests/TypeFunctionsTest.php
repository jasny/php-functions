<?php

namespace Jasny;

/**
 * Test type functions
 */
class TypeFunctionsTest extends \PHPUnit_Framework_TestCase
{
    const NONE = 0;
    const NUMERIC = 1;
    const ASSOC = 2;
    
    public function varProvider()
    {
        return [
            [['foo', 'bar'], self::NUMERIC],
            [['a' => 'foo', 'b' => 'bar'], self::ASSOC],
            [[1 => 'foo', 'bar'], self::ASSOC],
            [['foo', 'b' => 'bar'], self::ASSOC],
            [['foo', 2 => 'bar'], self::ASSOC],
            [[], self::NUMERIC],
            ['foo', self::NONE],
            [(object)['a' => 'b'], self::NONE]
        ];
    }
    
    /**
     * @covers Jasny\is_associative_array
     * @dataProvider varProvider
     * 
     * @param mixed $var
     * @param int   $type
     */
    public function testIsAssociativeArray($var, $type)
    {
        $this->assertEquals($type === self::ASSOC, is_associative_array($var));
    }
    
    /**
     * @covers Jasny\is_numeric_array
     * @dataProvider varProvider
     * 
     * @param mixed $var
     * @param int   $type
     */
    public function testIsNumericArray($var, $type)
    {
        $this->assertEquals($type === self::NUMERIC, is_numeric_array($var));
    }
    
    
    public function objectifyProvider()
    {
        return [
            [
                'foo',
                'foo'
            ],
            [
                ['a' => 'foo'],
                (object)['a' => 'foo']
            ],
            [
                ['foo', 'bar', 'zoo'],
                ['foo', 'bar', 'zoo']
            ],
            [
                ['a' => ['b' => ['c' => 'foo']]],
                (object)['a' => (object)['b' => (object)['c' => 'foo']]]
            ],
            [
                (object)['a' => ['b' => ['c' => 'foo']]],
                (object)['a' => (object)['b' => (object)['c' => 'foo']]]
            ],
            [
                ['a' => 'foo', 'b' => ['bar', 'zoo'], 'c' => true],
                (object)['a' => 'foo', 'b' => ['bar', 'zoo'], 'c' => true]
            ],
            [
                [1 => 'a', 'b'],
                (object)['1' => 'a', '2' => 'b']
            ],
            [
                [],
                []
            ]
        ];
    }
    
    /**
     * @covers Jasny\objectify
     * @dataProvider objectifyProvider
     * 
     * @param mixed $var
     * @param mixed $expect
     */
    public function testObjectify($var, $expect)
    {
        $this->assertEquals($expect, objectify($var));
    }
    
    
    public function arrayifyProvider()
    {
        return [
            [
                'foo',
                'foo'
            ],
            [
                (object)['a' => 'foo'],
                ['a' => 'foo']
            ],
            [
                (object)['a' => (object)['b' => (object)['c' => 'foo']]],
                ['a' => ['b' => ['c' => 'foo']]],
            ],
            [
                ['a' => (object)['b' => (object)['c' => 'foo']]],
                ['a' => ['b' => ['c' => 'foo']]]
            ],
            [
                (object)['date' => new \DateTime('2000-01-01')],
                ['date' => new \DateTime('2000-01-01')]
            ],
            [
                new \stdClass(),
                []
            ]
        ];
    }
    
    /**
     * @covers Jasny\arrayify
     * @dataProvider arrayifyProvider
     * 
     * @param mixed $var
     * @param mixed $expect
     */
    public function testArrayify($var, $expect)
    {
        $this->assertEquals($expect, arrayify($var));
    }

    
    public function circularReferenceProvider()
    {
        $object = new \stdClass();
        $object->items = [
            'foo',
            $object
        ];
        
        return [
            [$object]
        ];
    }
    
    /**
     * @covers Jasny\objectify
     * @dataProvider circularReferenceProvider
     * 
     * @expectedException \OverflowException
     * @expectedExceptionMessage Maximum recursion depth reached. Possible circular reference.
     * 
     * @param stdClass $object
     */
    public function testObjectifyCircularReference(\stdClass $object)
    {
        objectify($object);
    }
    
    /**
     * @covers Jasny\arrayify
     * @dataProvider circularReferenceProvider
     * 
     * @expectedException \OverflowException
     * @expectedExceptionMessage Maximum recursion depth reached. Possible circular reference.
     * 
     * @param stdClass $object
     */
    public function testArrayifyCircularReference(\stdClass $object)
    {
        arrayify($object);
    }
}
