<?php

namespace Jasny\Tests;

use function Jasny\get_type_description;
use function Jasny\is_stringable;
use PHPStan\Testing\TestCase;

use function Jasny\expect_type;
use function Jasny\is_associative_array;
use function Jasny\is_numeric_array;
use function Jasny\objectify;
use function Jasny\arrayify;

/**
 * Test type functions
 * @coversNothing
 */
class TypeFunctionsTest extends TestCase
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
     * @covers \Jasny\is_associative_array
     * @dataProvider varProvider
     *
     * @param mixed $var
     * @param int $type
     */
    public function testIsAssociativeArray($var, $type)
    {
        $this->assertEquals($type === self::ASSOC, is_associative_array($var));
    }

    /**
     * @covers \Jasny\is_numeric_array
     * @dataProvider varProvider
     *
     * @param mixed $var
     * @param int $type
     */
    public function testIsNumericArray($var, $type)
    {
        $this->assertEquals($type === self::NUMERIC, is_numeric_array($var));
    }

    public function stringableProvider()
    {
        return [
            [null, false],
            [true, false],
            ['', true],
            ['foo', true],
            [0, true],
            [42, true],
            [1.23, true],
            [(object)['a' => 'b'], false],
            [new class() { function __toString() { return 'f'; } }, true]
        ];
    }

    /**
     * @covers \Jasny\is_stringable
     * @dataProvider stringableProvider
     */
    public function testIsStringable($var, $expected)
    {
        $this->assertSame($expected, is_stringable($var));
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
     * @covers \Jasny\objectify
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
     * @covers \Jasny\arrayify
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
     * @covers \Jasny\objectify
     * @dataProvider circularReferenceProvider
     * 
     * @expectedException \OverflowException
     * @expectedExceptionMessage Maximum recursion depth reached. Possible circular reference.
     */
    public function testObjectifyCircularReference(\stdClass $object)
    {
        objectify($object);
    }
    
    /**
     * @covers \Jasny\arrayify
     * @dataProvider circularReferenceProvider
     * 
     * @expectedException \OverflowException
     * @expectedExceptionMessage Maximum recursion depth reached. Possible circular reference.
     */
    public function testArrayifyCircularReference(\stdClass $object)
    {
        arrayify($object);
    }

    public function typeDescriptionProvider()
    {
        $closedResource = fopen('php://memory', 'r+');
        fclose($closedResource);

        return [
            [10, 'integer'],
            [10.2, 'float'],
            [true, 'boolean'],
            [[], 'array'],
            [(object)[], 'stdClass object'],
            [new \DateTime(), 'DateTime object'],
            [fopen('data://text/plain,hello', 'r'), 'stream resource'],
            [$closedResource, 'resource (closed)']
        ];
    }

    /**
     * @covers \Jasny\get_type_description
     * @dataProvider typeDescriptionProvider
     */
    public function testGetTypeDescription($var, $expected)
    {
        $type = get_type_description($var);

        $this->assertSame($expected, $type);
    }

    
    public function expectTypeProvider()
    {
        $streamResource = fopen('data://text/plain,a', 'r');

        $closedResource = fopen('php://memory', 'r+');
        fclose($closedResource);

        return [
            [10, 'int'],
            [10, 'integer'],
            [true, 'bool'],
            [true, 'boolean'],
            [[], 'array'],
            [(object)[], 'stdClass'],
            [10, ['int', 'boolean']],
            ['foo', 'int', "Expected int, string given"],
            ['foo', ['int', 'boolean'], "Expected int or boolean, string given"],
            [(object)[], 'Foo', "Expected Foo object, stdClass object given"],
            [$streamResource, 'resource'],
            [$streamResource, 'stream resource'],
            [$streamResource, ['stream resource', 'gd resource']],
            [$streamResource, 'string', "Expected string, stream resource given"],
            [$streamResource, 'gd resource', "Expected gd resource, stream resource given"],
            [$streamResource, ['int', 'gd resource'], "Expected int or gd resource, stream resource given"],
            [$streamResource, 'stream', "Expected stream object, stream resource given"],
            [$closedResource, 'string', "Expected string, resource (closed) given"]
        ];
    }
    
    /**
     * @covers \Jasny\expect_type
     * @dataProvider expectTypeProvider
     * 
     * @param mixed           $var
     * @param string|string[] $type
     * @param string|false    $error
     */
    public function testExpectType($var, $type, $error = false)
    {
        if ($error) {
            $this->expectException(\InvalidArgumentException::class);
            $this->expectExceptionMessage($error);
        }
        
        expect_type($var, $type, \InvalidArgumentException::class);

        $this->assertTrue(true); // No warnings
    }
    
    /**
     * @covers \Jasny\expect_type
     * 
     * @expectedException Exception
     * @expectedExceptionMessage Lorem ipsum string black
     */
    public function testExpectTypeExplicitMessage()
    {
        expect_type('foo', 'int', \Exception::class, "Lorem ipsum %s black");
    }

    /**
     * @covers \Jasny\expect_type
     *
     * @expectedException Exception
     * @expectedExceptionMessage Lorem int ipsum string black
     */
    public function testExpectTypeExplicitMessageType()
    {
        expect_type('foo', 'int', \Exception::class, 'Lorem %2$s ipsum %1$s black');
    }
}
