<?php

namespace Jasny;

use PHPUnit\Framework\TestCase;

/**
 * Test object functions
 * @coversNothing
 */
class ObjectFunctionsTest extends TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new class() {
            public $foo = 'woo';
            public $bar = 'BAR';
            protected $qux = 'qqq';
            private $tol = 'lot';

            public function getProperties($dynamic = false)
            {
                return \Jasny\object_get_properties($this, $dynamic);
            }
        };
    }

    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetProperties()
    {
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], object_get_properties($this->object));
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], $this->object->getProperties());
    }

    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetPropertiesDynamic()
    {
        $this->object->color = 'red';

        $expected = ['foo' => 'woo', 'bar' => 'BAR', 'color' => 'red'];
        $this->assertSame($expected, object_get_properties($this->object, true));
        $this->assertSame($expected, $this->object->getProperties(true));
    }

    /**
     * @covers Jasny\object_get_properties
     */
    public function testObjectGetPropertiesNotDynamic()
    {
        $this->object->color = 'red';

        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], object_get_properties($this->object, false));
        $this->assertSame(['foo' => 'woo', 'bar' => 'BAR'], $this->object->getProperties(false));
    }


    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetProperties()
    {
        object_set_properties($this->object, ['foo' => 'cool', 'bar' => 'land']);

        $this->assertAttributeSame('cool', 'foo', $this->object);
        $this->assertAttributeSame('land', 'bar', $this->object);
    }

    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetPropertiesDynamic()
    {
        object_set_properties($this->object, ['foo' => 'cool', 'bar' => 'land', 'color' => 'red'], true);

        $this->assertObjectHasAttribute('color', $this->object);
        $this->assertAttributeSame('red', 'color', $this->object);
    }

    /**
     * @covers Jasny\object_set_properties
     */
    public function testObjectSetPropertiesNotDynamic()
    {
        object_set_properties($this->object, ['foo' => 'cool', 'bar' => 'land', 'color' => 'red'], false);

        $this->assertObjectNotHasAttribute('color', $this->object);
    }
}

